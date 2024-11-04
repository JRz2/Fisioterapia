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
        // Cargar las sesiones programadas para la consulta específica
        $this->horarios = Horario::where('consulta_id', $consultaId)->get();
    }

    public function edit($id)
    {
        // Seleccionar la sesión a editar
        $this->selectedHorario = Horario::find($id);
        $this->nuevaFecha = $this->selectedHorario->fecha_inicio; // Inicializar con la fecha actual
    }

    public function update()
    {
        // Validar que la nueva fecha no esté vacía
        $this->validate([
            'nuevaFecha' => 'required|date',
        ]);

        // Actualizar la sesión seleccionada
        $this->selectedHorario->update(['fecha_inicio' => $this->nuevaFecha]);

        // Limpiar campos después de la actualización
        $this->reset(['selectedHorario', 'nuevaFecha']);
        session()->flash('message', 'Sesión actualizada con éxito.');
    }

    public function render()
    {
        return view('livewire.horario-edit');
    }
}
