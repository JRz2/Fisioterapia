<?php

namespace App\Livewire;

use App\Models\Evaluacion;
use Livewire\Component;

class EvaluacionCreate extends Component
{
    public $localidad,
        $aparicion,
        $duracion,
        $intensidad,
        $caracter,
        $irradiacion,
        $atenuantes;

    public $ultimaConsultaId;
    public $consulta_id;
    public $consultaId;
    public $editMode = false;

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $evaluacion = Evaluacion::where('consulta_id',$this->consultaId)->first();
        if ($evaluacion){
            $this->localidad = $evaluacion->localidad;
            $this->aparicion = $evaluacion->aparicion;
            $this->duracion = $evaluacion->duracion;
            $this->intensidad = $evaluacion->intensidad;
            $this->caracter = $evaluacion->caracter;
            $this->irradiacion = $evaluacion->irradiacion;
            $this->atenuantes = $evaluacion->atenuantes;
            $this->editMode = true;
        }
    }

    public function save(){
        if ($this->editMode){
            $evaluacion = Evaluacion::where('consulta_id',$this->consultaId)->first();
            $evaluacion->update([
                'localidad' => $this->localidad,
                'aparicion' => $this->aparicion,
                'duracion' => $this->duracion,
                'intensidad' => $this->intensidad,
                'caracter' => $this->caracter,
                'irradiacion' => $this->irradiacion,
                'atenuantes' => $this->atenuantes,
            ]);
            $this->dispatch('swal:success', [
                'title' => 'Evalucaion',
                'text' => 'Actualizado Correctamente',
            ]);
        }else{
            $evaluacion = new Evaluacion();
            $evaluacion->consulta_id = $this->consultaId;
            $evaluacion->localidad = $this->localidad;
            $evaluacion->aparicion = $this->aparicion;
            $evaluacion->duracion = $this->duracion;
            $evaluacion->intensidad = $this->intensidad;
            $evaluacion->caracter = $this->caracter;
            $evaluacion->irradiacion = $this->irradiacion;
            $evaluacion->atenuantes = $this->atenuantes;
            $evaluacion->save();
            $this->dispatch('swal:success', [
                'title' => 'Evaluacion',
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
        return view('livewire.evaluacion-create');
    }
}
