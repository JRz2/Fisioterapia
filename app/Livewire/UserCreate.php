<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UserCreate extends Component
{
    use WithFileUploads;
    protected $listeners = ['confirmUpdate'];

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $imagen;
    public $roles = [];
    public $allRoles = [];
    public $opencreate = false;
    public $openedit = false;
    public $editMode = false;
    public $user_edit_id;
    public $valueImage = false;
    public $imagenkey;

    public function mount()
    {
        $this->allRoles = Role::all();
    }

    public function confirmUpdate($data)
    {

        $dataRes = json_decode(json_encode($data));

        if ($data) {
            $this->openedit = true;
            $user = User::find($dataRes[0]->id);
            $this->user_edit_id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->imagen = $user->imagen;
        }
    }

    public function create()
    {
        $this->resetValidation();
        $this->opencreate = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name' => 'Nombre requerido',
            'email' => 'Email requerido',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);
        $user = User::create(
            $this->only('name', 'email')
                + [
                    'password' => bcrypt($this->password),
                ]
        );

        $this->reset(['name', 'email', 'password', 'password_confirmation']);
        if ($this->imagen) {
            $user->imagen = $this->imagen->store('users');
            $user->save();
        } else {
            $this->imagen = "image/user.png";
            $user->imagen = $this->imagen;
            $user->save();
        }

        $this->imagenkey = rand();
        $this->dispatch('swal:success', [
            'title' => 'Usuario',
            'text' => 'Creado Correctamente',
        ]);
        $this->dispatch('user-created');
        $this->opencreate = false;
        $this->imagenkey = rand();
        $this->imagen = "";
    }

    public function update()
    {
        $this->openedit = true;
        $this->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'imagen' => 'nullable|image|max:1024',
        ], [
            'name' => 'Nombre requerido',
            'email' => 'Email requerido',
        ]);
        $user = User::find($this->user_edit_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
         if ($this->imagen) {
            if ($user->imagen) {
                Storage::delete('users/' . $user->imagen);
            }
            $user->imagen = $this->imagen->store('users');
            $user->save();
        }
        $this->reset(['name', 'email', 'imagen']);
        $this->dispatch('user-created');
        $this->dispatch('swal:success', [
            'title' => 'Usuario',
            'text' => 'Actualizado Correctamente',
        ]);

        $this->imagen = null;
        $this->dispatch('user-updated');
        $this->dispatch('swal:success', [
            'title' => 'Usuario actualizado',
            'text' => 'El usuario ha sido actualizado correctamente.',
        ]);
        $this->reset(['name', 'email', 'imagen']);
        $this->openedit = false;
        $this->imagenkey = rand();
    }

    public function keyrand()
    {
        $this->opencreate = false;
        $this->openedit = false;
        $this->reset(['name', 'email', 'password', 'password_confirmation']);
        $this->imagenkey = rand();
        $this->imagen = "";
    }

    public function clickImage()
    {
        if ($this->imagen) {
            $this->valueImage = true;
        } else {
            $this->valueImage = false;
        }
    }

    public function render()
    {
        return view('livewire.user-create');
    }
}
