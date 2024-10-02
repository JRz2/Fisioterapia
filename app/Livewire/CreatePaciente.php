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
        $genero,
        $direccion,
        $deporte,
        $celular,
        $ocupacion,
        $ci,
        $imagen;
        

    public $opencreate = false;

    public $pacientes;

    public $imagenkey;

    /*protected function rules()
    {
        return [
            'imagen' => 'nullable|image|max:2048', // Opcional: máximo 2MB
            'ocupacion' => 'required|string|max:255',
            'deporte' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'paterno' => 'required|string|max:255',
            'materno' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:255',
            'genero' => 'required|string',
            'edad' => 'required|integer|min:0|max:3', // Asegura que la edad sea un número entero positivo
            'celular' => 'required|integer|max:8', // Ajusta según el formato deseado
        ];
    }*/

    public function create()
    {

        $this->resetValidation();
        $this->opencreate = true;
    }

    public function save()
    {

        $this->validate([
            'nombre' => 'required',
            'paterno' => 'required',
            'edad' => 'required',
            'genero' => 'required',
            'celular' => 'min:8',
        ], [
            'nombre' => 'Nombre requerido',
            'paterno' => 'Apellido Paterno requerido',
            'edad' => 'Edad requerido',
            'genero' => 'Genero requerido',
        ]);

        $paciente = Paciente::create(
            $this->only('nombre', 'paterno', 'materno', 'edad','ci', 'genero', 'direccion', 'ocupacion', 'deporte', 'celular')
        );

        $this->reset(['nombre', 'paterno', 'materno', 'edad','ci', 'genero', 'direccion', 'ocupacion', 'deporte', 'celular']);

        if ($this->imagen) {
            $paciente->imagen = $this->imagen->store('pacientes');
            $paciente->save();
        }

        $this->imagenkey = rand();
        
        $this->dispatch('paciente-created');
        
        $this->opencreate = false;
        $this->imagenkey = rand();
        $this->imagen = "";
        

    }

    public function keyrand()
    {
        $this->imagenkey = rand();
        $this->imagen = "";
        $this->ci = '';
        $this->nombre = '';
        $this->paterno = '';
        $this->materno = '';
        $this->direccion = '';
        $this->ocupacion = '';
        $this->deporte = '';
        $this->genero = '';
        $this->edad = '';
        $this->celular = '';
        $this->imagen = null;
    }

    public function render()
    {
        return view('livewire.create-paciente');
    }


}
