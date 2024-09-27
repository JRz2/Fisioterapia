<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImgsesionCreate extends Component
{
    use WithFileUploads;
    public $imagenes = [];

    public function updatedImagenes()
    {
        dd($this->imagenes);
        $this->validate([
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    public function render()
    {
        return view('livewire.imgsesion-create');
    }
}
