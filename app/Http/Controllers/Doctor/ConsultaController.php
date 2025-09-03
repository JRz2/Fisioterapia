<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConsultaController extends Controller
{

   /* public function __construct()
    {
        $this->middleware('can:doctor.consulta.index')->only('index');
        $this->middleware('can:doctor.consulta.create')->only('create','store');
        $this->middleware('can:doctor.consulta.edit')->only('edit','update');
        $this->middleware('can:doctor.consulta.destroy')->only('destroy');

    }*/

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultas = Consulta::whereDate('fecha', '!=', Carbon::today())->get();
        $consultasHoy = Consulta::whereDate('fecha', Carbon::today())->get(); 
        return view('doctor.consulta.index', compact('consultas', 'consultasHoy'));        
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {       
        $pacienteId = $request->query('paciente');  

        $paciente = Paciente::find($pacienteId);      
        //dd($paciente);
        return view('doctor.consulta.create',compact('paciente'));
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
    public function show( $id)
    {   
        $consulta = Consulta::with(['paciente', 'diagnostico', 'examen.imgexamen'])->findOrFail($id);
        $paciente = $consulta->paciente;
        $diagnostico = $consulta->diagnostico;
        $examen = $consulta->examen;
        $imgexamen = $consulta->examen?->imgexamen; 
        $img= "";  
        if ($diagnostico && $diagnostico->img){      
            if($diagnostico->img == "torso"){
                $img = "https://sketchfab.com/models/76ae95bb378e448ebcebcfd6d331a0b4/embed";
            }elseif($diagnostico->img == "brazo"){
                $img = "https://sketchfab.com/models/c429dcefb2a3423ea0438f0d661b4c4a/embed";
            }elseif($diagnostico->img == "antebrazo"){
                $img = "https://sketchfab.com/models/0515550a617c4d9f896f9e2aee4631fc/embed";
            }elseif($diagnostico->img == "mano"){
                $img = "https://sketchfab.com/models/6c685cffa0cf4e1986d0440b8b9eba87/embed";
            }elseif($diagnostico->img == "pierna"){
                $img = "https://sketchfab.com/models/4dc37d737a354f9cb13b0d513630f6b9/embed";
            }elseif($diagnostico->img == "entrepierna"){
                $img = "https://sketchfab.com/models/a9e52fc383a84f8095128e27f602b218/embed";
            }elseif($diagnostico->img == "pie"){
                $img = "https://sketchfab.com/models/cf3074f2a9a44b029f79c08d0b279b38/embed";
            }elseif($diagnostico->img == "rodilla"){
                $img = "https://sketchfab.com/models/5a0d77ca78f84697ab4a967b35b549fe/embed";
            } else{
                $img = null;
            }
        } 
        return view('doctor.consulta.show', ['consulta' => $consulta, 'paciente' => $paciente, 'diagnostico' => $diagnostico, 'examen' => $examen, 'imgexamen' => $imgexamen, 'img' => $img]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {   
        return view('doctor.consulta.edit',compact('id'));
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
