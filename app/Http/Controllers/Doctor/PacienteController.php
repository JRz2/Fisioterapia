<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Antropometria;
use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:doctor.paciente.index')->only('index');
        $this->middleware('can:doctor.paciente.create')->only('create','store');
        $this->middleware('can:doctor.paciente.edit')->only('edit','update');
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
        //$antropometria = Antropometria::all();
        $consultas = $paciente->consulta;
        //$antro = $consultas->antropometria;
        //$antro = $paciente->consulta()->with('antropometria')->latest()->first();
        //$antro = $paciente->consulta()->with('antropometria')->get();
        $ultimaConsulta = $paciente->consulta()->latest()->first();
        //dd($antro);
        return view('doctor.paciente.show', compact('paciente', 'consultas', 'ultimaConsulta'));
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