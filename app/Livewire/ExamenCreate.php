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

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $exa = Examen::where('consulta_id',$this->consultaId)->first();
        if ($exa){
            $this->examen = $exa->examen;
            $this->prueba = $exa->prueba;
        }
    }

    public function save(){

        $existemov = Examen::where('consulta_id',$this->consultaId)->first();
        if ($existemov){
            $this->examen = $existemov->examen;
            $this->prueba = $existemov->prueba;
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
