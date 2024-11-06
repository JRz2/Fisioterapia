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
        
        return view('doctor.consulta.show', ['consulta' => $consulta, 'paciente' => $paciente, 'diagnostico' => $diagnostico, 'examen' => $examen, 'imgexamen' => $imgexamen]);
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
