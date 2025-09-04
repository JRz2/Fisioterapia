<?php

namespace App\Livewire;
use App\Models\Imgconsulta;
use Livewire\Component;
use Livewire\WithFileUploads;

class ConsultaImg extends Component
{
    use WithFileUploads;         
    public $openadd = false;
    public $imagen = [];
    public $consultaId;

    public function mount(){
    }

    public function saveadd(){  
        if ($this->imagen) {
            foreach ($this->imagen as $img) {
                $path = $img->store('examens'); 
                Imgconsulta::create([
                    'consulta_id' => $this->consultaId, 
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

    public function cancelar(){
        $this->reset('imagen');
    }

    public function create(){
        $this->openadd = true;
    }

    public function render()
    {
        return view('livewire.consulta-img');
    }
}
