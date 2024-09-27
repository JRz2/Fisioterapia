<?php

namespace App\Livewire;

use App\Models\Paciente;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePaciente extends Component
{
    use WithFileUploads;
    public $nombre, 
    $paterno, 
    $materno, 
    $edad, 
    $genero ="123", 
    $direccion, 
    $deporte, 
    $celular, 
    $ocupacion,
    $imagen;

    public $opencreate = false;

    public $pacientes;

    public $imagenkey;

    public function create(){

        $this->resetValidation();
        $this->opencreate = true;
    }

    public function save(){

        $this->validate([
            'nombre' => 'required',
            'paterno' => 'required',
            'edad' => 'required',
            'genero' => 'required',
            'celular' => 'min:6',
        ],[
            'nombre' => 'Nombre requerido',
            'paterno' => 'Apellido Paterno requerido',
            'edad' => 'Edad requerido',
            'genero' => 'Genero requerido',
        ]);

        $paciente = Paciente::create(
            $this->only('nombre','paterno','materno','edad','genero','direccion','ocupacion','deporte','celular')
        );
         
        $this->reset(['nombre','paterno','materno','edad','genero','direccion','ocupacion','deporte','celular']);

        if($this->imagen){
            $paciente->imagen = $this->imagen->store('pacientes');
            $paciente->save();
        }

        $this->imagenkey = rand();    
        $this->dispatch('paciente-created');
        $this->opencreate = false;
        $this->imagenkey = rand();
        $this->imagen="";

    }

    public function keyrand(){
        $this->imagenkey = rand();
        $this->imagen="";
    }

    public function render()
    {   
        return view('livewire.create-paciente');
    }

}
