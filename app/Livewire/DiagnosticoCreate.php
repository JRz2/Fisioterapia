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
    public $editMode = false;

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $diagnostico = Diagnostico::where('consulta_id',$this->consultaId)->first();
        if ($diagnostico){
            $this->diagnostico = $diagnostico->diagnostico;
            $this->plan = $diagnostico->plan;
            $this->editMode = true;
        }
    }

    public function save()
    {
        if ($this->editMode){
            $diagnostico = Diagnostico::where('consulta_id',$this->consultaId)->first();
            $diagnostico->update([
                'diagnostico' => $this->diagnostico,
                'plan' => $this->plan,
            ]);
            $this->dispatch('swal:success', [
                'title' => 'Diagnostico',
                'text' => 'Actualizado Correctamente',
            ]);
        }else{
            $diagnostico = new Diagnostico();
            $diagnostico->consulta_id = $this->consultaId;
            $diagnostico->diagnostico = $this->diagnostico;
            $diagnostico->plan = $this->plan;
            $diagnostico->save();
            $this->dispatch('swal:success', [
            'title' => 'Diagnostico',
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
        return view('livewire.diagnostico-create');
    }
}
