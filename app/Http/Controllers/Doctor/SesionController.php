<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Sesion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sesiones = Sesion::whereDate('fecha', '!=', Carbon::today())->get();
        $sesionesHoy = Sesion::whereDate('fecha', Carbon::today())->get(); 
        return view('doctor.sesion.index', compact('sesiones', 'sesionesHoy'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctor.sesion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $consulta_id = 1;
        $codigo = "S009";
        $fecha = "05/02/2025";
        $recomendacion = "Seguir con el tratamiento";
        $fechaConvertida = Carbon::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
        $data = $request->validate([
            'postura_inicial' => 'required|string',
            'postura_final' => 'required|string',
        ]);
    
        // Si es necesario, decodifica el JSON
        $data['postura_inicial'] = json_decode($data['postura_inicial'], true);
        $data['postura_final'] = json_decode($data['postura_final'], true);
    
        // Guarda la sesión (suponiendo que tienes un modelo Sesion)
        Sesion::create([
            'consulta_id' => $consulta_id,
            'codigo' => $codigo,
            'fecha' => $fechaConvertida,
            'recomendacion' => $recomendacion,
            'postura_inicial' => json_encode($data['postura_inicial']),
            'postura_final' => json_encode($data['postura_final']),
        ]);
    
        return redirect()->route('doctor.sesion.create')->with('success', 'Sesión guardada exitosamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $session = Sesion::findOrFail($id);
        //dd($id);
        //dd($session);
        return view('doctor.sesion.show', compact('session'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
