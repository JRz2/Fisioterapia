<?php

namespace App\Livewire;

use App\Models\Imgsesion;
use App\Models\Sesion;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class SesionCreate extends Component
{
    use WithFileUploads;

    public $consultaId;
    
    public $codigo,
        $fecha,
        $sintoma,
        $observacion,
        $recomendacion,
        $tratamiento;
    
        public $opencreate = false;
        public $sesion;
        public $imagenkey;
        public $image;
        public $imagenes = [];
        public $ruta=[];

    public function create(){
            $this->resetValidation();
            $this->opencreate = true;
        }

    public function save(){
        $this->validate([
            'fecha'=>'required',
        ]);

        $lastSesion = Sesion::where('consulta_id', $this->consultaId)
        ->orderBy('codigo', 'desc')
        ->first();

        if ($lastSesion) {
            $lastCode = intval(substr($lastSesion->codigo, 1));
            $newCode = $lastCode + 1;
        } else {
        $newCode = 1;
        }

        $codigo = 'S' . str_pad($newCode, 3, '0', STR_PAD_LEFT);

        $sesion = Sesion::create([
            'fecha' => $this->fecha,
            'consulta_id' => $this->consultaId,
            'codigo' => $codigo,
            'sintoma' => $this->sintoma,
            'observacion' => $this->observacion,
            'recomendacion' => $this->recomendacion,
            'tratamiento' => $this->tratamiento,
        ]);

        if ($this->ruta) {
            foreach ($this->ruta as $img) {
                $path = $img->store('sesions', 'public'); 

                Imgsesion::create([
                    'sesion_id' => $sesion->id, 
                    'ruta' => $path,
                ]);
            }
        }

        $this->dispatch('sesion-created');
        $this->opencreate = false;
        $this->reset(['fecha','sintoma','observacion','recomendacion','tratamiento']);
    }

    
    public function keyrand()
    {
            $this->imagenkey = rand();
            
    }


    public function render()
    {
        return view('livewire.sesion-create');
    }

    public function mount(){
        date_default_timezone_set('America/La_Paz');
        $this->fecha = Carbon::now()->toDateString();
    }

}
