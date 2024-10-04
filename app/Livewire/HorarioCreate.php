<?php

namespace App\Livewire;

use App\Models\Consulta;
use App\Models\Horario;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Carbon\Carbon;

class HorarioCreate extends Component
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'consulta_id' => 'required|exists:consultas,id',
            'dias' => 'required|array', // Los días seleccionados (e.g., ['lunes', 'miércoles', 'sábado'])
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio', // Opcional
        ]);

        // Guardar los horarios
        foreach ($request->dias as $dia) {
            Horario::create([
                'consulta_id' => $request->consulta_id,
                'dia' => $dia,
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
            ]);
        }
    }

    public function generarSesiones(Horario $horario)
    {
        $fechas = [];
        $fechaInicio = Carbon::parse($horario->fecha_inicio);
        $fechaFin = $horario->fecha_fin ? Carbon::parse($horario->fecha_fin) : Carbon::now()->addMonths(1); // Si no hay fecha fin, se genera para un mes
        
        $diasSemana = [
            'lunes' => Carbon::MONDAY,
            'martes' => Carbon::TUESDAY,
            'miércoles' => Carbon::WEDNESDAY,
            'jueves' => Carbon::THURSDAY,
            'viernes' => Carbon::FRIDAY,
            'sábado' => Carbon::SATURDAY,
            'domingo' => Carbon::SUNDAY,
        ];
        
        $dia = $diasSemana[$horario->dia];
        
        // Empezamos a generar las fechas
        for ($date = $fechaInicio->copy(); $date <= $fechaFin; $date->addDay()) {
            if ($date->dayOfWeek === $dia) {
                $fechas[] = [
                    'fecha' => $date->format('Y-m-d'),
                    'hora_inicio' => $horario->hora_inicio,
                    'hora_fin' => $horario->hora_fin
                ];
            }
        }

        return $fechas;
    }


    public function render()
    {
        $consultas = Consulta::all();
        return view('livewire.horario-create', compact('consultas'));
    }
}
