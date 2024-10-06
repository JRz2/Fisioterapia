<?php

namespace App\Livewire;

use App\Models\Paciente;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class CreatePaciente extends Component
{
    use WithFileUploads;
    protected $listeners = ['confirmUpdate'];

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
    public $valueImage = false;

    public $paciente_edit_id;
    public $paciente;
    public $editMode = false;

        
    public function confirmUpdate($data)
    {

        $dataRes = json_decode(json_encode($data));
        /*$this->dispatch('swal:confirm', [
            'title' => 'Paciente ',
            'text' => '¿Estas seguro de eliminarlo?',
            'confirmButtonText' => 'Sí, Eliminar',
            'cancelButtonText' => 'Cancelar',
            'data' => $dataRes[0]->id
        ]);*/

        if ($data) {
            $this->editMode = true;
            $this->opencreate = true;
            $paciente = Paciente::find($dataRes[0]->id);
            $this->paciente_edit_id = $paciente->id;
            $this->nombre = $paciente->nombre;
            $this->paterno = $paciente->paterno;
            $this->materno = $paciente->materno;
            $this->ci = $paciente->ci;
            $this->edad = $paciente->edad;
            $this->genero = $paciente->genero;
            $this->direccion = $paciente->direccion;
            $this->deporte = $paciente->deporte;
            $this->celular = $paciente->celular;
            $this->ocupacion = $paciente->ocupacion;
            $this->imagen = $paciente->imagen;
        }
    }


    public function create()
    {
        $this->resetValidation();
        $this->opencreate = true;
    }

    public function save()
    {

        $this->validate([
            /*'nombre' => 'required',
            'paterno' => 'required',
            'edad' => 'required',
            'genero' => 'required',
            'celular' => 'min:8',*/ // Opcional: máximo 2MB
            'ocupacion' => 'string|max:255',
            'deporte' => 'string|max:255',
            'nombre' => 'required|string|max:255',
            'paterno' => 'required|string|max:255',
            'materno' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:255',
            'genero' => 'required|string',
            'edad' => 'required|integer', // Asegura que la edad sea un número entero positivo
            'celular' => 'required|integer', // Ajusta según el formato deseado
        ], [
            'nombre' => 'Nombre requerido',
            'paterno' => 'Apellido Paterno requerido',
            'edad' => 'Edad requerido',
            'genero' => 'Genero requerido',
        ]);
        if ($this->editMode) {
            $paciente = Paciente::find($this->paciente_edit_id);
            $paciente->update([
                'nombre' => $this->nombre,
                'paterno' => $this->paterno,
                'materno' => $this->materno,
                'edad' => $this->edad,
                'genero' => $this->genero,
                'direccion' => $this->direccion,
                'deporte' => $this->deporte,
                'celular' => $this->celular,
                'ocupacion' => $this->ocupacion,
                'ci' => $this->ci
            ]);

            if($paciente->imagen == null || ''){
                $paciente->imagen = $this->imagen->store('pacientes');
                $paciente->update();
            } else if($this->imagen != $paciente->imagen){
                Storage::delete('pacientes/'.$paciente->imagen);
                $paciente->imagen = $this->imagen->store('pacientes');
                $paciente->update();
            }
            $this->imagen = null;
            $this->dispatch('paciente-created');
            $this->opencreate = false;
            $this->dispatch('swal:success', [
                'title' => 'Paciente',
                'text' => 'Actualizado Correctamente',
            ]);
        } else {
            $paciente = Paciente::create(
                $this->only('nombre', 'paterno', 'materno', 'edad', 'ci', 'genero', 'direccion', 'ocupacion', 'deporte', 'celular')
            );
            $this->reset(['nombre', 'paterno', 'materno', 'edad', 'ci', 'genero', 'direccion', 'ocupacion', 'deporte', 'celular']);
            if ($this->imagen) {
                $paciente->imagen = $this->imagen->store('pacientes');
                $paciente->save();
            }
            $this->imagenkey = rand();
            $this->dispatch('swal:success', [
                'title' => 'Paciente',
                'text' => 'Creado Correctamente',
            ]);
            $this->dispatch('paciente-created');
            $this->opencreate = false;
            $this->imagenkey = rand();
            $this->imagen = "";
        }

        $this->reset(['nombre', 'paterno', 'materno', 'edad', 'ci', 'genero', 'direccion', 'ocupacion', 'deporte', 'celular']);
        $this->editMode = false;
    }

    public function keyrand()
    {
        $this->opencreate = false;
        $this->editMode = false;
        $this->reset(['nombre', 'paterno', 'materno', 'edad', 'ci', 'genero', 'direccion', 'ocupacion', 'deporte', 'celular', 'imagen']);
        $this->imagenkey = rand();
        /*$this->imagen = "";
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
        $this->imagen = null;*/
    }

    public function clickImage(){
        if($this->editMode == true){
            $this->valueImage = true;
        }else{
            $this->valueImage = false;
        } 
    }

    public function render()
    {
        return view('livewire.create-paciente');
    }
}
