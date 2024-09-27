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
        $sesiones = Sesion::where('consulta_id', $this->consultaId)->with('imgsesion')->get();
        return view('livewire.index-sesion', ['sesiones' => $sesiones]);
    }

    public function mount($consultaId)
    {   
        $this->consultaId = $consultaId;
    }
}
