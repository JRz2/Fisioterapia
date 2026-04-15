<?php

namespace App\Http\Controllers\Fisio;

use App\Http\Controllers\Controller;
use App\Traits\MotorRecomendacionML;
use App\Models\Paciente;
use App\Models\Consulta;
use App\Models\Sesion;
use App\Models\Ejercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecomendacionController extends Controller
{
    use MotorRecomendacionML;
    
    /**
     * Mostrar recomendaciones para un paciente
     */
    public function index($pacienteId)
    {
        $paciente = Paciente::findOrFail($pacienteId);
        
        // Obtener recomendaciones usando ML
        $recomendaciones = $this->recomendarPorExitoSimilar($pacienteId, 10);
        
        // Si no hay recomendaciones por ML, usar patología
        if ($recomendaciones->isEmpty()) {
            $patologia = $this->getPatologiaDelPaciente($pacienteId);
            if ($patologia) {
                $recomendaciones = $this->recomendarPorPatologia($patologia->id, 10);
                $metodoUsado = 'patologia';
            } else {
                $recomendaciones = collect();
                $metodoUsado = 'sin_datos';
            }
        } else {
            $metodoUsado = 'machine_learning';
        }
        
        // Obtener sesiones activas del paciente
        $ultimaConsulta = Consulta::where('paciente_id', $pacienteId)
            ->orderBy('fecha', 'desc')
            ->first();
        
        $sesionesPendientes = [];
        if ($ultimaConsulta) {
            $sesionesPendientes = Sesion::where('consulta_id', $ultimaConsulta->id)
                ->whereNull('tratamiento')
                ->orWhere('tratamiento', '')
                ->get();
        }
        
        return view('fisio.recomendaciones.index', compact(
            'paciente', 
            'recomendaciones', 
            'metodoUsado',
            'ultimaConsulta',
            'sesionesPendientes'
        ));
    }
    
    /**
     * Asignar ejercicios a una sesión
     */
    public function asignarEjercicios(Request $request)
    {
        $request->validate([
            'sesion_id' => 'required|exists:sesions,id',
            'ejercicios' => 'required|array',
            'ejercicios.*' => 'exists:ejercicios,id'
        ]);
        
        $sesion = Sesion::find($request->sesion_id);
        
        foreach ($request->ejercicios as $ejercicioId) {
            DB::table('sesion_ejercicios')->insert([
                'sesion_id' => $sesion->id,
                'ejercicio_id' => $ejercicioId,
                'completado' => false,
                'puntos_ganados' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Actualizar el tratamiento de la sesión (texto)
        $ejerciciosNombres = Ejercicio::whereIn('id', $request->ejercicios)
            ->pluck('nombre')
            ->implode(', ');
        
        $sesion->update([
            'tratamiento' => $ejerciciosNombres,
            'recomendacion' => 'Realizar los ejercicios asignados ' . $ejerciciosNombres
        ]);
        
        return redirect()->back()->with('success', 'Ejercicios asignados correctamente');
    }
}