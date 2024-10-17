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

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $insp = Inspeccion::where('consulta_id',$this->consultaId)->first();
        if ($insp){
            $this->observacion = $insp->observacion;
            $this->plano_anterior = $insp->plano_anterior;
            $this->plano_lateral = $insp->plano_lateral;
            $this->plano_posterior = $insp->plano_posterior;
        }
    }


    public function save(){

        $existeinsp = Inspeccion::where('consulta_id',$this->consultaId)->first();
        if ($existeinsp){
            $this->observacion = $existeinsp->observacion;
            $this->plano_anterior = $existeinsp->plano_anterior;
            $this->plano_lateral = $existeinsp->plano_lateral;
            $this->plano_posterior = $existeinsp->plano_posterior;
            //dd("actualizar");
        }else{
            $insp = new Inspeccion();
            $insp->consulta_id = $this->consultaId;
            $insp->observacion = $this->observacion;
            $insp->plano_anterior = $this->plano_anterior;
            $insp->plano_lateral = $this->plano_lateral;
            $insp->plano_posterior = $this->plano_posterior;
            $insp->save();
            //dd("guardar");
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
