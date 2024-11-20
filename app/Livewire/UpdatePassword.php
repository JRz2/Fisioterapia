<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UpdatePassword extends Component
{   
    public $userId;
    public $imagen;
    public $openupdate = false;
    public $imagenkey;
    public $password;
    public $password_confirmation;
    public $password_actual;

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function edit()
    {
        $user = User::find($this->userId);
        $this->imagen = $user->imagen;
        $this->resetValidation();
        $this->openupdate = true;
    }

    public function update(){

        $this->validate([
            'password_actual' => ['required', 'current_password'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        $user = User::find($this->userId);
        $user->update([
            'password' => bcrypt($this->password),
        ]);
        $this->openupdate = false;
        $this->dispatch('swal:success', [
            'title' => 'Contraseña Cambiada',
            'text' => 'La contraseña ha sido actualizado correctamente.',
        ]);
    }

    public function render()
    {
        return view('livewire.update-password');
    }
}
