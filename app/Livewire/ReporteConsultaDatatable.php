<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Reporte;
use Illuminate\Database\Eloquent\Builder;

class ReporteConsultaDatatable extends DataTableComponent
{
    public $consultaId;
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

    public function builder(): Builder
    {
        $query = Reporte::query();

        if ($this->consultaId !== null) {
            $query->where('consulta_id', $this->consultaId);
        }

        return $query;
    }
}
