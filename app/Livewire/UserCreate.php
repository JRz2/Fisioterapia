<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserCreate extends Component
{
    protected $listeners = ['editUser', 'deleteUser'];

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $imagen;
    public $roles = [];
    public $allRoles = [];
    public $opencreate = false;
    public $editMode = false;
    public $user_edit_id;
    public $valueImage = false;
    public $imagenkey;

    public function mount()
    {
        $this->allRoles = Role::all();
    }

    public function create()
    {
        $this->resetValidation();
        $this->opencreate = true;
    }

    public function save()
    {
        $this->validate([
            'name'=>'required|unique:users',
            'email'=>'required|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name' => 'Nombre requerido',
            'email' => 'Email requerido',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);
        if ($this->editMode) {
            $user = User::find($this->user_edit_id);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if($user->imagen == null || ''){
                $user->imagen = $this->imagen->store('users');
                $user->update();
            } else if($this->imagen != $user->imagen){
                Storage::delete('users/'.$user->imagen);
                $user->imagen = $this->imagen->store('users');
                $user->update();
            }
            $user->roles()->sync($this->roles);
            $this->imagen = null;
            $this->dispatch('user-created');
            $this->opencreate = false;
            $this->dispatch('swal:success', [
                'title' => 'Usuario',
                'text' => 'Actualizado Correctamente',
            ]);
        } else {
            $user = User::create(
                $this->only('name','email')
                + [
                'password' => bcrypt('password'),
            ]);

            if ($this->imagen) {
                $user->imagen = $this->imagen->store('users');
                $user->save();
            }

            $this->reset(['name', 'email', 'password', 'password_confirmation']);
            if ($this->imagen) {
                $user->imagen = $this->imagen->store('users');  
                $user->save();  
            } else{
                $this->imagen = "image/user.png"; 
                $user->imagen = $this->imagen;  
                $user->save();  
            }
                    
            $this->imagenkey = rand();
            $this->dispatch('swal:success', [
                'title' => 'Paciente',
                'text' => 'Creado Correctamente',
            ]);
            $this->dispatch('paciente-created');
            $this->opencreate = false;
            $this->imagenkey = rand();
            $this->imagen = "";
        }

        $this->reset(['name', 'email']);
        $this->editMode = false;
    }

    public function keyrand()
    {
        $this->opencreate = false;
        $this->editMode = false;
        $this->reset(['name', 'email','password','password_confirmation']);
        $this->imagenkey = rand();
    }

    public function clickImage(){
        if($this->imagen){
            $this->valueImage = true;
        }else{
            $this->valueImage = false;
        } 
    }

    public function render()
    {
        return view('livewire.user-create');
    }
}
