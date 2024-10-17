<?php

namespace App\Livewire;

use App\Models\Diagnostico;
use Livewire\Component;

class DiagnosticoCreate extends Component
{
    public $diagnostico;
    public $plan;
    public $ultimaConsultaId;
    public $consulta_id;
    public $consultaId;

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $diagnostico = Diagnostico::where('consulta_id',$this->consultaId)->first();
        if ($diagnostico){
            $this->diagnostico = $diagnostico->diagnostico;
            $this->plan = $diagnostico->plan;
        }
    }

    public function save(){

        $diagnostico = Diagnostico::where('consulta_id',$this->consultaId)->first();
        if ($diagnostico){
            $this->diagnostico = $diagnostico->diagnostico;
            $this->plan = $diagnostico->plan;
            //dd("actualizar");
        }else{
            $diagnostico = new Diagnostico();
            $diagnostico->consulta_id = $this->consultaId;
            $diagnostico->diagnostico = $this->diagnostico;
            $diagnostico->plan = $this->plan;
            $diagnostico->save();
            //dd("guardar");
        }
    }

    public function validateNavBar($data)
    {
        $this->dispatch('confirmValidate', [$data]);
    }

    public function render()
    {
        return view('livewire.diagnostico-create');
    }
}
