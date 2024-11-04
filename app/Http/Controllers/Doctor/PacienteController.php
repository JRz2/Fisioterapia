<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:doctor.paciente.index')->only('index');
        $this->middleware('can:doctor.paciente.create')->only('create', 'store');
        $this->middleware('can:doctor.paciente.edit')->only('edit', 'update');
        $this->middleware('can:doctor.paciente.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('doctor.paciente.index');
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
    public function show(Paciente $paciente)
    {
        $consultas = $paciente->consulta;

        $consulta = $paciente->consulta()
        ->with('antropometria')
        ->orderByDesc('fecha')
        ->orderByDesc('id')
        ->get();

        $ultimaAntropometria = $consulta->firstWhere('antropometria', '!=', null)?->antropometria;

        $ultimaConsulta = $paciente->consulta()->latest()->first();
                
        return view('doctor.paciente.show', compact('paciente', 'consultas', 'ultimaConsulta', 'ultimaAntropometria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /*$creadPa = Paciente::find($id); // Obtén el paciente por su ID
        return view('livewire.index-paciente', compact('creadPa'));*/
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