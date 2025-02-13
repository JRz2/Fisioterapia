<?php

namespace App\Livewire;
use App\Models\Imgexamen;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImgexamenAdd extends Component
{   
    use WithFileUploads;         
    public $openadd = false;
    public $imagen = [];
    public $examenId;

    public function mount(){
    }

    public function saveadd(){  
        if ($this->imagen) {
            foreach ($this->imagen as $img) {
                $path = $img->store('examens', 'public'); 
                Imgexamen::create([
                    'examen_id' => $this->examenId, 
                    'ruta' => $path,
                ]);
            }
        }
        $this->dispatch('imgexamen-created');
        $this->dispatch('swal:success', [
            'title' => 'Imagenes',
            'text' => 'Guardado Correctamente',
        ]);
        $this->reset('imagen');
        $this->openadd = false;
    }

    public function add(){
        $this->openadd = true;
    }

    public function cancelar()
    {
        $this->reset('imagen');
    }

    public function render()
    {   
        return view('livewire.imgexamen-add');
    }
}