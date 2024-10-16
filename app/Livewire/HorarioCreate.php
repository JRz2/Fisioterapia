<?php

namespace App\Livewire;
use App\Models\Horario;
use Livewire\Component;


class HorarioCreate extends Component
{
    
    public $dias = []; // Días seleccionados
    public $consultaId;
    public $fecha_inicio;
    public $fecha_fin;
    public $horarios = [
        'lunes' => ['hora_inicio' => null, 'hora_fin' => null],
        'martes' => ['hora_inicio' => null, 'hora_fin' => null],
        'miércoles' => ['hora_inicio' => null, 'hora_fin' => null],
        'jueves' => ['hora_inicio' => null, 'hora_fin' => null],
        'viernes' => ['hora_inicio' => null, 'hora_fin' => null],
        'sábado' => ['hora_inicio' => null, 'hora_fin' => null],
        'domingo' => ['hora_inicio' => null, 'hora_fin' => null],
    ];

    public function save()
    {
        // Asegúrate de que 'dias' es un array de días seleccionados.
        foreach ($this->dias as $dia) {
            // Verifica si existe el horario correspondiente en $horarios
            if (!empty($this->horarios[$dia]['hora_inicio']) && !empty($this->horarios[$dia]['hora_fin'])) {

                // Calcular la fecha del primer día seleccionado a partir de la fecha de inicio
                $primeraFecha = $this->getFechaPrimerDia($this->fecha_inicio, $dia);

                // Crear la sesión con la fecha ajustada
                Horario::create([
                    'consulta_id' => $this->consultaId,
                    'dia' => $dia,
                    'hora_inicio' => $this->horarios[$dia]['hora_inicio'],
                    'hora_fin' => $this->horarios[$dia]['hora_fin'],
                    'fecha_inicio' => $primeraFecha, // Fecha calculada del primer día
                    'fecha_fin' => $this->fecha_fin,
                ]);
            }
        }

        // Limpiar los campos después de guardar
        $this->reset(['dias', 'horarios', 'fecha_inicio', 'fecha_fin']);
        session()->flash('message', 'Horarios programados con éxito.');
    }

    private function getFechaPrimerDia($fechaInicio, $diaSeleccionado)
    {
        // Mapear días de la semana a números (0 = domingo, 6 = sábado)
        $diasSemana = [
            'domingo' => 0,
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6,
        ];

        // Obtener el número del día actual de la fecha de inicio
        $fechaInicio = new \DateTime($fechaInicio);
        $diaInicio = $fechaInicio->format('w'); // 'w' devuelve el día de la semana (0 = domingo, 6 = sábado)

        // Obtener el número del día seleccionado
        $diaSeleccionadoNumero = $diasSemana[$diaSeleccionado];

        // Calcular la diferencia de días
        $diferenciaDias = ($diaSeleccionadoNumero - $diaInicio + 7) % 7;

        // Si la diferencia es 0, significa que la fecha de inicio ya es el día seleccionado.
        if ($diferenciaDias == 0) {
            return $fechaInicio->format('Y-m-d');
        }

        // Sumar la diferencia de días a la fecha de inicio para obtener el próximo día seleccionado
        $fechaInicio->modify("+{$diferenciaDias} days");

        return $fechaInicio->format('Y-m-d');
    }

    public function validateNavBar($data)
    {
        $this->dispatch('confirmValidate', [$data]);
    }

    public function render()
    {
        return view('livewire.horario-create');
    }
}
