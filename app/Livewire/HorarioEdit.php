<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Horario;

class HorarioEdit extends Component
{   
    public $consultaId;
    public $horarios;
    public $selectedHorario;
    public $nuevaFecha;
    public $aplicarATodas = false;
    public $diasSimilares = [];
    public $diasSeleccionados = [];

    public function mount($consultaId)
    {
        $this->horarios = Horario::where('consulta_id', $consultaId)->get();
    }

    public function edit($id)
    {
        $this->selectedHorario = Horario::find($id);
        $this->nuevaFecha = $this->selectedHorario->fecha_inicio; 
    }

    public function update()
    {
        $this->validate([
            'nuevaFecha' => 'required|date',
        ]);

        $this->selectedHorario->update(['fecha_inicio' => $this->nuevaFecha]);

        $this->reset(['selectedHorario', 'nuevaFecha']);
        session()->flash('message', 'Sesión actualizada con éxito.');
    }

    public function render()
    {
        return view('livewire.horario-edit');
    }
}
