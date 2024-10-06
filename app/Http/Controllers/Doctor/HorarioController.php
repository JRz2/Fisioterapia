<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las sesiones programadas con los horarios
        $horarios = Horario::all();

        // Formatear los horarios para el FullCalendar
        $eventos = [];
        foreach ($horarios as $horario) {
            $eventos[] = [
                'title' => 'Sesión de Paciente ID: ' . $horario->consulta->paciente_id, // o el nombre del paciente si tienes la relación
                'start' => $horario->fecha_inicio . 'T' . $horario->hora_inicio,
                'end'   => $horario->fecha_inicio . 'T' . $horario->hora_fin,
                'backgroundColor' => '#007bff', // Puedes cambiar el color
                'borderColor' => '#007bff',
            ];
    }

    // Retornar a la vista con los eventos
    return view('doctor.horario.index', compact('eventos'));

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
    public function show(string $id)
    {
        //
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
