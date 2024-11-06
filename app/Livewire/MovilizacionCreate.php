<?php

namespace App\Livewire;

use App\Models\Movilizacion;
use Livewire\Component;

class MovilizacionCreate extends Component
{
    public $contractura,
        $retraccion,
        $gatillo,
        $goniometria,
        $balance_muscular,
        $mensuras,
        $perimetros;

    public $ultimaConsultaId;
    public $consulta_id;
    public $consultaId;
    public $editMode = false;

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $mov = Movilizacion::where('consulta_id',$this->consultaId)->first();
        if ($mov){
            $this->contractura = $mov->contractura;
            $this->retraccion = $mov->retraccion;
            $this->gatillo = $mov->gatillo;
            $this->goniometria = $mov->goniometria;
            $this->balance_muscular = $mov->balance_muscular;
            $this->mensuras = $mov->mensuras;
            $this->perimetros = $mov->perimetros;
            $this->editMode = true;
        }
    }

    public function save()
    {
        if ($this->editMode){
            $movilizacion = Movilizacion::where('consulta_id',$this->consultaId)->first();
            $movilizacion->update([
                'contractura' => $this->contractura,
                'retraccion' => $this->retraccion,
                'gatillo' => $this->gatillo,
                'goniometria' => $this->goniometria,
                'balance_muscular' => $this->balance_muscular,
                'mensuras' => $this->mensuras,
                'perimetros' => $this->perimetros,
            ]);
            $this->dispatch('swal:success', [
                'title' => 'Palpacion',
                'text' => 'Actualizado Correctamente',
            ]);
        }else{
            $mov = new Movilizacion();
            $mov->consulta_id = $this->consultaId;
            $mov->contractura = $this->contractura;
            $mov->retraccion = $this->retraccion;
            $mov->gatillo = $this->gatillo;
            $mov->goniometria = $this->goniometria;
            $mov->balance_muscular = $this->balance_muscular;
            $mov->mensuras = $this->mensuras;
            $mov->perimetros = $this->perimetros;
            $mov->save();
            $this->dispatch('swal:success', [
                'title' => 'Palpacion',
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
        return view('livewire.movilizacion-create');
    }
}
