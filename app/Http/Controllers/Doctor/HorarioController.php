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

    return view('doctor.horario.index');
 
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

    public function calendario(){
              $horarios = Horario::all();
              $eventos = [];
              foreach ($horarios as $horario) {
                  $eventos[] = [
                      'title' => 'Paciente ' . $horario->consulta->paciente->nombre,
                      'start' => $horario->fecha_inicio . 'T' . $horario->hora_inicio,
                      'end'   => $horario->fecha_inicio . 'T' . $horario->hora_fin,
                      'backgroundColor' => '#007bff', 
                      'borderColor' => '#007bff',
                  ];
          }
      
          return view('doctor.horario.calendario', compact('eventos'));
    }
}
