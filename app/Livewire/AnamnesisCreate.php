<?php

namespace App\Livewire;
use App\Models\Anamnesis;
use Livewire\Component;

class AnamnesisCreate extends Component
{
    public $antecedentes,
        $motivo,
        $historia_actual;

    public $an;
    public $ultimaConsultaId;
    public $consulta_id;
    public $consultaId;
    public $editMode = false;

    public function mount($consultaId)
    {
        $this->consultaId = $consultaId;
        $this->an = Anamnesis::where('consulta_id', $this->consultaId)->first();
        if ($this->an) {
            $this->antecedentes = $this->an->antecedentes;
            $this->motivo = $this->an->motivo;
            $this->historia_actual = $this->an->historia_actual;
            $this->editMode = true;
        }
    }

    public function save()
    {
        if($this->editMode){
            $an = Anamnesis::where('consulta_id', $this->consultaId)->first();
            $an->update([
                'antecedentes' => $this->antecedentes,
                'motivo' => $this->motivo,
                'historia_actual' => $this->historia_actual,
            ]);
            $this->dispatch('swal:success', [
                'title' => 'Anamnesis',
                'text' => 'Actualizado Correctamente',
            ]);
        } else{
            $an = new Anamnesis();
            $an->consulta_id = $this->consultaId;
            $an->antecedentes = $this->antecedentes;
            $an->motivo = $this->motivo;
            $an->historia_actual = $this->historia_actual;
            $an->save();
            $this->dispatch('swal:success', [
                'title' => 'Anamnesis',
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
        return view('livewire.anamnesis-create');
    }
}
