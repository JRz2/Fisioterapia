<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\Paciente;

trait MotorRecomendacionML
{
    /**
     * Obtiene la patología principal de un paciente según su última anamnesis
     */
    protected function getPatologiaDelPaciente($pacienteId)
    {
        $anamnesis = DB::table('anamneses')
            ->join('consultas', 'anamneses.consulta_id', '=', 'consultas.id')
            ->where('consultas.paciente_id', $pacienteId)
            ->orderBy('consultas.fecha', 'desc')
            ->first();
        
        if (!$anamnesis || !$anamnesis->motivo) {
            return null;
        }
        
        // Buscar patología que coincida con el motivo
        $motivo = strtolower($anamnesis->motivo);
        
        $patologias = DB::table('patologias')->get();
        
        foreach ($patologias as $patologia) {
            $nombrePatologia = strtolower($patologia->nombre);
            if (strpos($motivo, $nombrePatologia) !== false || 
                strpos($nombrePatologia, $motivo) !== false) {
                return $patologia;
            }
        }
        
        return null;
    }
    
    /**
     * Recomendar ejercicios por patología (Nivel Básico)
     */
    protected function recomendarPorPatologia($patologiaId, $limite = 10)
    {
        $ejercicios = DB::table('ejercicios')
            ->join('ejercicio_patologia', 'ejercicios.id', '=', 'ejercicio_patologia.ejercicio_id')
            ->where('ejercicio_patologia.patologia_id', $patologiaId)
            ->orderBy('ejercicio_patologia.nivel_evidencia', 'desc')
            ->orderBy('ejercicio_patologia.orden_recomendacion', 'asc')
            ->select('ejercicios.*', 'ejercicio_patologia.nivel_evidencia')
            ->limit($limite)
            ->get();
        
        return $ejercicios;
    }
    
    /**
     * Recomendar ejercicios basado en éxito de pacientes similares (ML Nivel 1)
     * Esta es la función de Machine Learning más importante
     */
    protected function recomendarPorExitoSimilar($pacienteId, $limite = 10)
    {
        $pacienteActual = Paciente::find($pacienteId);
        if (!$pacienteActual) {
            return collect();
        }
        
        // 1. Encontrar pacientes similares (misma edad +/- 5 años, mismo género)
        $pacientesSimilares = DB::table('pacientes')
            ->whereBetween('edad', [
                max(0, (int)$pacienteActual->edad - 5), 
                (int)$pacienteActual->edad + 5
            ])
            ->where('genero', $pacienteActual->genero)
            ->where('id', '!=', $pacienteId)
            ->pluck('id')
            ->toArray();
        
        if (empty($pacientesSimilares)) {
            // Si no hay similares, recomendar por patología
            $patologia = $this->getPatologiaDelPaciente($pacienteId);
            if ($patologia) {
                return $this->recomendarPorPatologia($patologia->id, $limite);
            }
            return collect();
        }
        
        // 2. Buscar ejercicios que tuvieron éxito en esos pacientes similares
        // Éxito = calidad 'excelente' o 'buena' y completado = true
        $ejerciciosExitosos = DB::table('sesion_ejercicios')
            ->join('sesions', 'sesion_ejercicios.sesion_id', '=', 'sesions.id')
            ->join('consultas', 'sesions.consulta_id', '=', 'consultas.id')
            ->whereIn('consultas.paciente_id', $pacientesSimilares)
            ->whereIn('sesion_ejercicios.calidad_ejecucion', ['excelente', 'buena'])
            ->where('sesion_ejercicios.completado', true)
            ->select(
                'sesion_ejercicios.ejercicio_id',
                DB::raw('COUNT(*) as veces_exitoso'),
                DB::raw('AVG(sesion_ejercicios.puntos_ganados) as promedio_puntos')
            )
            ->groupBy('sesion_ejercicios.ejercicio_id')
            ->orderBy('veces_exitoso', 'desc')
            ->orderBy('promedio_puntos', 'desc')
            ->limit($limite)
            ->get();
        
        if ($ejerciciosExitosos->isEmpty()) {
            // Fallback: recomendar por patología
            $patologia = $this->getPatologiaDelPaciente($pacienteId);
            if ($patologia) {
                return $this->recomendarPorPatologia($patologia->id, $limite);
            }
            return collect();
        }
        
        // 3. Obtener los detalles completos de los ejercicios
        $ejercicioIds = $ejerciciosExitosos->pluck('ejercicio_id')->toArray();
        
        $ejercicios = DB::table('ejercicios')
            ->whereIn('id', $ejercicioIds)
            ->get()
            ->map(function ($ejercicio) use ($ejerciciosExitosos) {
                $infoExito = $ejerciciosExitosos->firstWhere('ejercicio_id', $ejercicio->id);
                $ejercicio->score_ml = $infoExito->veces_exitoso;
                $ejercicio->puntos_promedio = $infoExito->promedio_puntos;
                return $ejercicio;
            })
            ->sortByDesc('score_ml');
        
        return $ejercicios;
    }
    
    /**
     * Registrar resultado de un ejercicio para que el ML aprenda
     */
    protected function registrarResultadoEjercicio($sesionEjercicioId, $calidad, $completado)
    {
        DB::table('sesion_ejercicios')
            ->where('id', $sesionEjercicioId)
            ->update([
                'calidad_ejecucion' => $calidad,
                'completado' => $completado,
                'updated_at' => now()
            ]);
        
        // También actualizar la tabla de recomendaciones_ml para aprendizaje futuro
        $sesionEjercicio = DB::table('sesion_ejercicios')
            ->where('id', $sesionEjercicioId)
            ->first();
        
        if ($sesionEjercicio && isset($sesionEjercicio->ejercicio_id)) {
            // Obtener el paciente_id desde la sesión
            $sesion = DB::table('sesions')->where('id', $sesionEjercicio->sesion_id)->first();
            $consulta = DB::table('consultas')->where('id', $sesion->consulta_id ?? null)->first();
            
            DB::table('recomendaciones_ml')->updateOrInsert(
                [
                    'paciente_id' => $consulta->paciente_id ?? null,
                    'ejercicio_id' => $sesionEjercicio->ejercicio_id,
                ],
                [
                    'veces_recomendado' => DB::raw('veces_recomendado + 1'),
                    'veces_completado_exitoso' => $completado ? DB::raw('veces_completado_exitoso + 1') : DB::raw('veces_completado_exitoso'),
                    'tasa_exito' => DB::raw('CASE WHEN veces_recomendado > 0 THEN (veces_completado_exitoso + ' . ($completado ? 1 : 0) . ') / (veces_recomendado + 1) ELSE 0 END'),
                    'updated_at' => now()
                ]
            );
        }
    }
}