<?php

namespace App\Livewire;

use App\Models\Horario;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HorarioShow extends Component
{   
    protected $listeners = ['editHorario'];
    public $openMode;
    public $openmodal;
    public $horario;
    public $dia;
    public $hora_inicio;
    public $hora_fin;
    public $fecha_inicio;
    public $estado;
    public $horarioId;
    
    public function editHorario($data)
    {   
        $this->resetModal();
        $dataRes = json_decode(json_encode($data));
        if ($data) {
            $this->openMode = true;
            $this->openmodal = true;
            $this->horario = Horario::find($dataRes[0]->id);
            $horario = Horario::find($dataRes[0]->id);
            $this->horarioId = $horario->id;
            $this->dia = $horario->dia;
            $this->hora_inicio = $horario->hora_inicio;
            $this->hora_fin = $horario->hora_fin;
            $this->fecha_inicio = $horario->fecha_inicio;
            $this->estado = (bool) $horario->estado;
        }

    }
    
    public function save(){
        $this->validate([
            'fecha_inicio' => 'required',
            'hora_inicio' => 'nullable|string|max:255',
            'hora_fin' => 'required|string|max:255',
        ], [
            'fecha_inicio' => 'Fecha es requerido',
            'hora_inicio' => 'Hora de inicio requerido',
            'hora_fin' => 'Hora de finalizacion requerido',
        ]);
        if($this->openMode){
            $this->dia = Carbon::parse($this->fecha_inicio)->locale('es')->dayName;
            $horario = Horario::find($this->horarioId);
            $horario->update([
                'fecha_inicio' => $this->fecha_inicio,
                'hora_inicio' => $this->hora_inicio,
                'hora_fin' => $this->hora_fin,
                'dia' => $this->dia,
                'estado' => $this->estado,
            ]);
            $this->dispatch('horario-update');
            $this->openmodal = false;
            $this->dispatch('swal:success', [
                'title' => 'Sesion',
                'text' => 'Actualizado Correctamente',
            ]);

        }
    }

    public function createUpdate() {
        
    }

    public function resetModal()
    {
        $this->reset(['openMode', 'openmodal', 'horario', 'dia', 'hora_inicio', 'hora_fin', 'fecha_inicio', 'estado', 'horarioId']);
    }

    public function updatedEstado($value)
    {
        \Log::info('Estado actualizado:', ['estado' => $value]);
    }
    
    public function render()
    {
        return view('livewire.horario-show');
    }
}
