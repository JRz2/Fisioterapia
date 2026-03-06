<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Consulta;

class ConsultallDatatable extends DataTableComponent
{
    protected $model = Consulta::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")->sortable()->collapseOnTablet()->searchable(),
            Column::make("Codigo", "codigo")->sortable()->searchable(),
            Column::make("Nombre", "paciente.nombre")->sortable()->collapseOnTablet()->searchable(),
            Column::make("Paterno", "paciente.paterno")->sortable()->collapseOnTablet()->searchable(),
            Column::make("Materno", "paciente.materno")->sortable()->collapseOnTablet()->searchable(),
            Column::make("Fecha", "fecha")->sortable()->collapseOnTablet()->searchable(),
        ];
    }
}
