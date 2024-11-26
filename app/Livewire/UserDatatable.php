<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Livewire\Attributes\On;
use PhpParser\Node\Expr\FuncCall;

class UserDatatable extends DataTableComponent
{
    protected $model = User::class;
    public $usertabla;
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    protected $listeners = ['destroy'];
    public $openedit;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")->sortable(),
            Column::make("Imagen", "imagen")->hideIf(true),
            Column::make("Imagen")->label(fn($row) => view('livewire.paciente-datatable', [
                'imagen' => strpos($row->imagen, 'image/') !== false 
                    ? asset($row->imagen) 
                    : asset('storage/app/public/' . $row->imagen),  
            ])),  
            Column::make("Nombre", "name")->sortable(),
            Column::make("Email", "email")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Rol", "roles.name")
                ->label(function ($row) {
                    if ($row->roles->isNotEmpty()) {
                        return $row->roles->map(function ($rol) {
                            return '<span class="badge badge-info">' . $rol->name . '</span>';
                        })->implode(' ');
                    } 
                    return '<span class="badge badge-danger">No asignado</span>';
                })
                ->html() 
                ->collapseOnTablet()
                ->sortable()
                ->searchable(),
            Column::make("Acciones")->collapseOnTablet()->label(fn($row) => view('livewire.user-actions', compact('row')))
        ];
    }

    public function mount($userId = null)
    {
        $this->userId = $userId;
    }

    #[On('user-created')]
    public function actualizarTabla()
    {
        $this->usertabla = $this->getUsers();
    }
    
    private function getUsers()
    {
    }

    public function createUpdate($data){
        $this->dispatch('confirmUpdate', [$data]); 
    }

    public function UserEdit($user){
        $userId = $user['id'];
        $user = User::find($userId);
        $this->resetValidation();
        $this->openedit = true;
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name' => 'Nombre requerido',
            'email' => 'Email requerido',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);

        $user = User::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            ]);

        $this->dispatch('swal:success', [
            'title' => 'Usuario',
            'text' => 'Actualizado Correctamente',
        ]);
        $this->openedit = false;

        $this->reset(['name', 'email', 'password', 'password_confirmation']);
    }

    public function confirm($dataUser)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Usuario ' . $dataUser['name'],
            'text' => '¿Estas seguro de eliminarlo?',
            'confirmButtonText' => 'Sí, Eliminar',
            'cancelButtonText' => 'Cancelar',
            'data' => $dataUser
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->dispatch('swal:success', [
                'title' => 'Usuario',
                'text' => 'Eliminado Correctamente',
            ]);
        } else {
            $this->dispatch('swal:error', [
                'title' => 'Error',
                'text' => 'No se pudo eliminar el usuario',
            ]);
        }
    }
}
