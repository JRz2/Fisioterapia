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
        $this->consultaId = $consultaId;
        $this->horarios = Horario::where('consulta_id', $consultaId)->get();
    }

    public function edit($horarioId)
    {
        $this->selectedHorario = Horario::find($horarioId);
        $this->nuevaFecha = $this->selectedHorario->fecha_inicio;

        // Buscar todas las sesiones similares (por ejemplo, todos los lunes)
        $this->diasSimilares = Horario::where('dia', $this->selectedHorario->dia)
                                     ->where('consulta_id', $this->consultaId)
                                     ->get()->toArray();
    }

    public function cancelEdit()
    {
        $this->reset(['selectedHorario', 'nuevaFecha', 'aplicarATodas', 'diasSeleccionados']);
    }

    public function update()
    {
        $this->validate([
            'nuevaFecha' => 'required|date',
        ]);

        if ($this->aplicarATodas) {
            // Actualizar todas las sesiones del mismo día
            Horario::where('dia', $this->selectedHorario->dia)
                   ->where('consulta_id', $this->consultaId)
                   ->update(['fecha_inicio' => $this->nuevaFecha]);

            $this->dispatchBrowserEvent('swal:success', [
                'message' => 'Todas las sesiones de ' . ucfirst($this->selectedHorario->dia) . ' se han actualizado con éxito.',
            ]);
        } elseif (count($this->diasSeleccionados) > 0) {
            // Actualizar solo los días seleccionados
            Horario::whereIn('id', $this->diasSeleccionados)
                   ->update(['fecha_inicio' => $this->nuevaFecha]);

            $this->dispatchBrowserEvent('swal:success', [
                'message' => 'Las sesiones seleccionadas se han actualizado con éxito.',
            ]);
        } else {
            // Actualizar solo la sesión seleccionada
            $this->selectedHorario->update([
                'fecha_inicio' => $this->nuevaFecha,
            ]);

            $this->dispatchBrowserEvent('swal:success', [
                'message' => 'La sesión se ha actualizado con éxito.',
            ]);
        }

        // Limpiar el formulario y recargar la lista
        $this->reset(['selectedHorario', 'nuevaFecha', 'aplicarATodas', 'diasSeleccionados']);
        $this->horarios = Horario::where('consulta_id', $this->consultaId)->get();
    }

    public function render()
    {
        return view('livewire.horario-edit');
    }
}
