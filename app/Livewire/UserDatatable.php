<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Livewire\Attributes\On;

class UserDatatable extends DataTableComponent
{
    protected $model = User::class;
    public $usertabla;


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
                    : asset('storage/' . $row->imagen),  
            ])),  
            Column::make("Name", "name")->sortable(),
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
}