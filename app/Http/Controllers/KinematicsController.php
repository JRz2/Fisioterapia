<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesion;

class KinematicsController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
public function show($id)
{
    $sesion = Sesion::with('consulta.paciente')->findOrFail($id);
    
    // Obtener datos biomecanicos - PUEDE SER STRING O ARRAY
    $datosRaw = $sesion->datos_biomecanicos;
    
    // Si es un string, decodificarlo
    if (is_string($datosRaw)) {
        $datos = json_decode($datosRaw, true);
    } else {
        $datos = $datosRaw;
    }
    
    // Verificar qué hay después de decodificar
    \Log::info('Datos decodificados:', $datos);
    
    // Extraer ángulos
    $angulos = [
        // Hombro derecho
        'hombro_d_flexion' => isset($datos['hombro']['derecha']['flexion']) ? floatval($datos['hombro']['derecha']['flexion']) : 0,
        'hombro_d_extension' => isset($datos['hombro']['derecha']['extension']) ? floatval($datos['hombro']['derecha']['extension']) : 0,
        
        // Rodilla derecha
        'rodilla_d_flexion' => isset($datos['rodilla']['derecha']['flexion']) ? floatval($datos['rodilla']['derecha']['flexion']) : 0,
        
        // Rodilla izquierda
        'rodilla_i_flexion' => isset($datos['rodilla']['izquierda']['flexion']) ? floatval($datos['rodilla']['izquierda']['flexion']) : 0,
        
        // Cadera derecha
        'cadera_d_flexion' => isset($datos['cadera']['derecha']['flexion']) ? floatval($datos['cadera']['derecha']['flexion']) : 0,
        
        // Cadera izquierda
        'cadera_i_flexion' => isset($datos['cadera']['izquierda']['flexion']) ? floatval($datos['cadera']['izquierda']['flexion']) : 0,
    ];
    
    \Log::info('Ángulos extraídos:', $angulos);
    
    // Obtener historial
    $historial = Sesion::where('consulta_id', $sesion->consulta_id)
        ->whereNotNull('datos_biomecanicos')
        ->orderBy('fecha', 'asc')
        ->get()
        ->map(function($s) {
            $raw = $s->datos_biomecanicos;
            if (is_string($raw)) {
                $d = json_decode($raw, true);
            } else {
                $d = $raw;
            }
            return [
                'id' => $s->id,
                'fecha' => $s->fecha->format('d/m/Y'),
                'hombro_d_flexion' => isset($d['hombro']['derecha']['flexion']) ? floatval($d['hombro']['derecha']['flexion']) : null,
                'rodilla_d_flexion' => isset($d['rodilla']['derecha']['flexion']) ? floatval($d['rodilla']['derecha']['flexion']) : null,
                'cadera_d_flexion' => isset($d['cadera']['derecha']['flexion']) ? floatval($d['cadera']['derecha']['flexion']) : null,
            ];
        })
        ->filter(function($item) {
            return $item['hombro_d_flexion'] !== null || $item['rodilla_d_flexion'] !== null;
        });
    
    return view('doctor.modelo.show', [
        'sesion' => $sesion,
        'paciente' => $sesion->consulta->paciente,
        'angulos' => $angulos,
        'historial' => $historial,
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'sesion_id' => 'required|exists:sesiones,id',
            'hombro_d_flexion' => 'nullable|numeric|min:0|max:180',
            'hombro_d_extension' => 'nullable|numeric|min:0|max:50',
            'rodilla_d_flexion' => 'nullable|numeric|min:0|max:140',
            'rodilla_i_flexion' => 'nullable|numeric|min:0|max:140',
            'cadera_d_flexion' => 'nullable|numeric|min:0|max:120',
            'notes' => 'nullable|string',
        ]);
        
        $sesion = Sesion::findOrFail($validated['sesion_id']);
        
        // Obtener datos existentes o crear nuevo array
        $datosBiomecanicos = $sesion->datos_biomecanicos ?? [];
        
        // Actualizar solo los campos que vienen
        if (isset($validated['hombro_d_flexion'])) {
            $datosBiomecanicos['hombro']['derecha']['flexion'] = $validated['hombro_d_flexion'] ?: null;
        }
        if (isset($validated['hombro_d_extension'])) {
            $datosBiomecanicos['hombro']['derecha']['extension'] = $validated['hombro_d_extension'] ?: null;
        }
        if (isset($validated['rodilla_d_flexion'])) {
            $datosBiomecanicos['rodilla']['derecha']['flexion'] = $validated['rodilla_d_flexion'] ?: null;
        }
        if (isset($validated['rodilla_i_flexion'])) {
            $datosBiomecanicos['rodilla']['izquierda']['flexion'] = $validated['rodilla_i_flexion'] ?: null;
        }
        if (isset($validated['cadera_d_flexion'])) {
            $datosBiomecanicos['cadera']['derecha']['flexion'] = $validated['cadera_d_flexion'] ?: null;
        }
        
        // Actualizar la fecha de medición
        $datosBiomecanicos['fecha_medicion'] = now()->toISOString();
        
        // Actualizar la sesión
        $sesion->update([
            'datos_biomecanicos' => $datosBiomecanicos,
            'observacion' => $validated['notes'] ?? $sesion->observacion,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Mediciones actualizadas correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
