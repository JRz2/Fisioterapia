<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Reporte;

class ReporteDatatable extends DataTableComponent
{
    protected $model = Reporte::class;

    public function configure(): void
    {
                $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setSearchStatus(false);
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setPerPageAccepted([5, 10, 25, 50, 100]);
        $this->setPerPage(5);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Fecha", "fecha")
                ->sortable(),
            Column::make("Diagnostico", "diagnostico")
                ->sortable(),
            Column::make("Acciones")->collapseOnTablet()
                ->label(fn($row) => view('livewire.reporte-actions', compact('row')))
        ];
    }
}
