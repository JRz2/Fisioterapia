<?php

namespace App\Livewire;

use App\Models\Consulta;
use Carbon\Carbon;
use Livewire\Component;

class ConsultaEdit extends Component
{   
    public $paciente;
    public $fecha;
    public $ultima_consulta;
    public $consultaId;

    public function mount()
    {   
        //dd($this->consultaId);
        $consulta = Consulta::find($this->consultaId);
        $paciente = $consulta->paciente;
        $this->paciente = $paciente;
        date_default_timezone_set('America/La_Paz');
        $this->fecha = Carbon::now()->toDateString();
        $this->ultima_consulta = Consulta::where('paciente_id', $consulta->paciente_id)
            ->latest()
            ->first() ?? new Consulta;;
    }

    public function render()
    {
        return view('livewire.consulta-edit');
    }
}
