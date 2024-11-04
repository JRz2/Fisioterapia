<?php

namespace App\Livewire;
use App\Models\Horario;
use Livewire\Component;


class HorarioCreate extends Component
{
    
    public $dias = []; 
    public $consultaId;
    public $sesiones;
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
        if (empty($this->sesiones) || $this->sesiones <= 0) {
            session()->flash('error', 'Por favor, ingrese un número válido de sesiones.');
            return;
        }

        foreach ($this->dias as $dia) {
            $primeraFecha = $this->getFechaPrimerDia($this->fecha_inicio, $dia);

            for ($i = 0; $i < $this->sesiones; $i++) {
                $fechaSesion = (new \DateTime($primeraFecha))->modify("+{$i} week");

                Horario::create([
                    'consulta_id' => $this->consultaId,
                    'dia' => $dia,
                    'hora_inicio' => $this->horarios[$dia]['hora_inicio'],
                    'hora_fin' => $this->horarios[$dia]['hora_fin'],
                    'fecha_inicio' => $fechaSesion->format('Y-m-d'), 
                    'fecha_fin' => $this->fecha_fin,
                    'sesiones' => $this->sesiones, 
                ]);
            }
        }

        $this->reset(['dias', 'horarios', 'fecha_inicio', 'sesiones']);
        $this->dispatch('swal:success', [
            'title' => 'Horaios',
            'text' => 'Creado Correctamente',
        ]);
    }

    

    private function getFechaPrimerDia($fechaInicio, $diaSeleccionado)
    {
        $diasSemana = [
            'domingo' => 0,
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6,
        ];

        $fechaInicio = new \DateTime($fechaInicio);
        $diaInicio = $fechaInicio->format('w'); 
        $diaSeleccionadoNumero = $diasSemana[$diaSeleccionado];

        $diferenciaDias = ($diaSeleccionadoNumero - $diaInicio + 7) % 7;

        if ($diferenciaDias == 0) {
            return $fechaInicio->format('Y-m-d');
        }

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
