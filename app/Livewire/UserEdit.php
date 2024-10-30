<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserEdit extends Component
{   
    use WithFileUploads;

    public $userId;
    public $name;
    public $email;
    public $imagen;
    public $openedit = false;
    public $imagenkey;

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function edit()
    {
        $user = User::find($this->userId);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->imagen = $user->imagen;
        $this->resetValidation();
        $this->openedit = true;
    }

    public function update()
    {

        $this->validate([
            'name' => 'required',
            'email' => 'required',
        ], [
            'name' => 'Nombre requerido',
            'email' => 'Email requerido',
        ]);

        $user = User::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            ]);

        if($user->imagen == null || ''){
            $user->imagen = $this->imagen->store('users');
            $user->update();
        }else if($this->imagen != $user->imagen){
            Storage::delete('pacientes/'.$user->imagen);
            $user->imagen = $this->imagen->store('users');
            $user->update();
        }
        $this->imagen = null;
        $this->dispatch('userUpdated');
        $this->openedit = false;
        $this->dispatch('swal:success', [
            'title' => 'Usuario',
            'text' => 'Actualizado Correctamente',
        ]);  

        $this->imagenkey = rand();
        $this->imagen = "";
        $this->reset(['name', 'email']);
    }

    public function keyrand()
    {
        $this->openedit = false;
        $this->reset(['name', 'email']);
        $this->imagenkey = rand();
    }

    public function render()
    {
        return view('livewire.user-edit');
    }
}
