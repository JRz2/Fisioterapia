<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sesion;

class SesionpacienteDatatable extends DataTableComponent
{
    protected $model = Sesion::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Fecha", "fecha")
                ->sortable(),
            Column::make("Codigo", "codigo")
                ->sortable(),
            Column::make("Sintoma", "sintoma")
                ->sortable(),
            Column::make("Observacion", "observacion")
                ->sortable(),
            Column::make("Recomendacion", "recomendacion")
                ->sortable(),
            Column::make("Tratamiento", "tratamiento")
                ->sortable(),
            Column::make("Consulta id", "consulta_id")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
