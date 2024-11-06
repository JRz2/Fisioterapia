<?php

namespace App\Livewire;

use App\Models\Examen;
use App\Models\Imgexamen;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExamenCreate extends Component
{   
    use WithFileUploads;
    public $examen;
    public $prueba;
    public $consultaId;
    public $ruta = [];
    public $editMode = false;

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $exa = Examen::where('consulta_id',$this->consultaId)->first();
        if ($exa){
            $this->examen = $exa->examen;
            $this->prueba = $exa->prueba;
            $this->editMode = true;
        }
    }

    public function save()
    {
        if ($this->editMode){
            $examen = Examen::where('consulta_id',$this->consultaId)->first();
            $examen->update([
                'examen' => $this->examen,
                'prueba' => $this->prueba,
            ]);
            $this->dispatch('swal:success', [
                'title' => 'Pruebas',
                'text' => 'Actualizado Correctamente',
            ]);
        }else{
            $examen = Examen::create([
                'consulta_id' => $this->consultaId,
                'examen' => $this->examen,
                'prueba' => $this->prueba,
            ]);
            if ($this->ruta) {
                foreach ($this->ruta as $img) {
                    $path = $img->store('examens', 'public'); 
                    Imgexamen::create([
                        'examen_id' => $examen->id, 
                        'ruta' => $path,
                    ]);
                }
            }
            $this->dispatch('swal:success', [
                'title' => 'Pruebas',
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
        return view('livewire.examen-create');
    }
}
