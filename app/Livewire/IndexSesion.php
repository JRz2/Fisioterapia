<?php

namespace App\Livewire;

use App\Models\Sesion;
use Livewire\Component;
use Livewire\Attributes\On;

class IndexSesion extends Component
{
    //public $row;
    public $consultaId;

    #[On('sesion-created')]
    public function render()
{
    // Recupera las sesiones con las posturas y las imágenes relacionadas
    $sesiones = Sesion::where('consulta_id', $this->consultaId)
                      ->with('imgsesion')
                      ->get();

    // Decodifica las posturas (si están en formato JSON)
    $sesiones->transform(function ($sesion) {
        $sesion->postura_inicial = json_decode($sesion->postura_inicial, true);
        $sesion->postura_final = json_decode($sesion->postura_final, true);
        return $sesion;
    });

    // Pasa los datos a la vista
    return view('livewire.index-sesion', [
        'sesiones' => $sesiones
    ]);
}
    /*public function render()
    {
        $sesiones = Sesion::where('consulta_id', $this->consultaId)->with('imgsesion')->get();
        $posturas =  $sesiones;
        $posturas->transform(function ($sesiones) {
            $sesiones->postura_inicial = json_decode($sesiones->postura_inicial, true);
            $sesiones->postura_final = json_decode($sesiones->postura_final, true);
        });
        return view('livewire.index-sesion', ['sesiones' => $sesiones, 'posturas' => $posturas]);
    }*/

    public function mount($consultaId)
    {   
        $this->consultaId = $consultaId;
    }
}
