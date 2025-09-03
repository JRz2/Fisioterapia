<?php

namespace App\Livewire;

use App\Models\Sesion;
use App\Models\Consulta;
use Livewire\Component;
use Livewire\Attributes\On;

class IndexSesion extends Component
{
    public $consultaId;
    public $imagenes;
    
    #[On('sesion-created')]
    public function render(){
        $sesiones = Sesion::where('consulta_id', $this->consultaId)
                        ->with('imgsesion')
                        ->get();

        $sesiones->transform(function ($sesion) {
            $sesion->postura_inicial = json_decode($sesion->postura_inicial, true);
            $sesion->postura_final = json_decode($sesion->postura_final, true);
            return $sesion;
        });

        return view('livewire.index-sesion', [
            'sesiones' => $sesiones
        ]);
    }

    public function mount($consultaId){   
        $consulta = Consulta::with('imgsesion')->findOrFail($consultaId);
        //$consulta = Consulta::with(['sesion.imgsesion'])->findOrFail($consultaId);
        $this->consultaId = $consultaId;
        $this->imagenes = $consulta->imgsesion;
    }
}
