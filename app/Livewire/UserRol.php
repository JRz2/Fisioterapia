<?php

namespace App\Livewire;

use Livewire\Component;

class UserRol extends Component
{
    use WithFileUploads;
    protected $listeners = ['confirmRol'];

    public $openRol = false;
    public function confirmRol($data)
    {       
        dd("hola2");
        $dataRes = json_decode(json_encode($data));
        if ($data) {
            $this->openRol = true;
        }
    }

    public function render()
    {
        return view('livewire.user-rol');
    }
}
