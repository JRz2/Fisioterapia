<?php

namespace App\Livewire;

use App\Models\Anamnesis;
use App\Models\Consulta;
use Livewire\Component;

class AnamnesisCreate extends Component
{
    public $antecedentes,
        $motivo,
        $historia_actual;

    public $ultimaConsultaId;
    public $consulta_id;
    public $consultaId;


    public function mount($consultaId)
    {
        $this->consultaId = $consultaId;
        $an = Anamnesis::where('consulta_id', $this->consultaId)->first();
        if ($an) {
            $this->antecedentes = $an->antecedentes;
            $this->motivo = $an->motivo;
            $this->historia_actual = $an->historia_actual;
        }
    }

    public function save()
    {

        $existan = Anamnesis::where('consulta_id', $this->consultaId)->first();
        if ($existan) {
            $this->antecedentes = $existan->antecedentes;
            $this->motivo = $existan->motivo;
            $this->historia_actual = $existan->historia_actual;
            //dd("actualizar");
        } else {
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
            //dd("guardar");
        }


        $existingAntropometria = Anamnesis::where('consulta_id', $this->consultaId)->first();


        if ($existingAntropometria) {
            $this->addError('consulta_id', 'Ya existe un registro de antropometria para esta consulta.');
            return;
        }

        $ultimaConsulta = Consulta::latest('id')->first();
        $this->consulta_id = $ultimaConsulta->id;
        $anamnesis = new Anamnesis();
        $anamnesis->consulta_id = $this->consulta_id;
        $anamnesis->antecedentes = $this->antecedentes;
        $anamnesis->motivo = $this->motivo;
        $anamnesis->historia_actual = $this->historia_actual;
        $anamnesis->save();

        //$this->dispatch('anamnesis-created');
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
