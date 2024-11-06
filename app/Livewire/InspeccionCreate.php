<?php

namespace App\Livewire;

use App\Models\Consulta;
use App\Models\Inspeccion;
use Livewire\Component;

class InspeccionCreate extends Component
{
    public $observacion,
        $plano_anterior,
        $plano_lateral,
        $plano_posterior;

    public $ultimaConsultaId;
    public $consulta_id;
    public $consultaId;
    public $editMode = false;

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $insp = Inspeccion::where('consulta_id',$this->consultaId)->first();
        if ($insp){
            $this->observacion = $insp->observacion;
            $this->plano_anterior = $insp->plano_anterior;
            $this->plano_lateral = $insp->plano_lateral;
            $this->plano_posterior = $insp->plano_posterior;
            $this->editMode = true;
        }
    }


    public function save()
    {
        if ($this->editMode){
            $inspeccion = Inspeccion::where('consulta_id',$this->consultaId)->first();
            $inspeccion->update([
                'observacion' => $this->observacion,
                'plano_anterior' => $this->plano_anterior,
                'plano_lateral' => $this->plano_lateral,
                'plano_posterior' => $this->plano_posterior,
            ]);
            $this->dispatch('swal:success', [
                'title' => 'Inspeccion',
                'text' => 'Actualizado Correctamente',
            ]);
        }else{
            $insp = new Inspeccion();
            $insp->consulta_id = $this->consultaId;
            $insp->observacion = $this->observacion;
            $insp->plano_anterior = $this->plano_anterior;
            $insp->plano_lateral = $this->plano_lateral;
            $insp->plano_posterior = $this->plano_posterior;
            $insp->save();
            $this->dispatch('swal:success', [
                'title' => 'Inspeccion',
                'text' => 'Creado Correctamente',
            ]);
            $this->editMode = true;
        }

    }

    public function validateNavBar($data)
    {
        $this->dispatch('confirmValidate', [$data]);
    }

    public function render()
    {
        return view('livewire.inspeccion-create');
    }
}
