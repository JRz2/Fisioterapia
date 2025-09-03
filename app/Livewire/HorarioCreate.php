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

    public function mount($consultaId)
    {
        $this->consultaId = $consultaId;
        $this->horario = Horario::where('consulta_id', $this->consultaId)->first();
        $this->dispatch('horarioGuardado');

    }

    public function save()
    {
        if (empty($this->sesiones) || $this->sesiones <= 0) {
            session()->flash('error', 'Por favor, ingrese un número válido de sesiones.');
            return;
        }
    
        Horario::where('consulta_id', $this->consultaId)->delete();
    
        $fechaBase = new \DateTime($this->fecha_inicio);
        $sesionesCreadas = 0;  
    
        $diasSeleccionados = array_filter($this->dias, fn($dia) => in_array($dia, ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo']));
    
        usort($diasSeleccionados, function ($dia1, $dia2) {
            $diasSemana = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
            return array_search($dia1, $diasSemana) - array_search($dia2, $diasSemana);
        });
    
        while ($sesionesCreadas < $this->sesiones) {
            foreach ($diasSeleccionados as $dia) {
                $fechaSesion = $this->obtenerFechaDia($fechaBase, $dia, $sesionesCreadas);
                if ($sesionesCreadas < $this->sesiones) {
                    Horario::create([
                        'consulta_id' => $this->consultaId,
                        'dia' => $dia,
                        'hora_inicio' => $this->horarios[$dia]['hora_inicio'],
                        'hora_fin' => $this->horarios[$dia]['hora_fin'],
                        'fecha_inicio' => $fechaSesion->format('Y-m-d'),
                        'fecha_fin' => $this->fecha_fin,
                        'sesiones' => $this->sesiones,
                    ]);
                    $sesionesCreadas++;
                }
                if ($sesionesCreadas >= $this->sesiones) {
                    break;
                }
            }
            $fechaBase->modify('+1 week');
        }
       /* \Log::debug("Fecha de inicio: ", [$this->fecha_inicio]);
        \Log::debug("Días seleccionados: ", [$this->dias]);
        \Log::debug("Sesiones creadas hasta ahora: ", [$sesionesCreadas]);*/
        $this->reset(['dias', 'horarios', 'fecha_inicio', 'sesiones']);

        $this->dispatch('swal:success', [
            'title' => 'Horarios',
            'text' => 'Creado Correctamente',
        ]);
    }
    
    
    
    private function obtenerFechaDia(\DateTime $fechaBase, $diaSeleccionado, $sesionesCreadas)
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
    
        $diaSeleccionadoNumero = $diasSemana[$diaSeleccionado];
        $fechaBase = clone $fechaBase;
        $diaActual = $fechaBase->format('w'); 
        $diasHastaDiaSeleccionado = ($diaSeleccionadoNumero - $diaActual + 7) % 7;
        if ($diasHastaDiaSeleccionado > 0) {
            $fechaBase->modify("+{$diasHastaDiaSeleccionado} days");
        } 
       // \Log::debug("Fecha base ajustada: ", [$fechaBase->format('Y-m-d')]);
        return $fechaBase;
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
