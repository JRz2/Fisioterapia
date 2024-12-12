<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Reporte;
use Illuminate\Database\Eloquent\Builder;

class ReporteDatatable extends DataTableComponent
{
    protected $model = Reporte::class;
    public $pacienteId;

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
            Column::make("Id", "id")->sortable()->collapseOnTablet()->searchable(),  
            Column::make("Codigo", "consulta.codigo")->sortable(),    
            Column::make("Fecha", "fecha")->sortable()->collapseOnTablet(),
            Column::make("Acciones")->collapseOnTablet()
                ->label(fn($row) => view('livewire.reporte-actions', compact('row')))
        ];
    }

    public function builder(): Builder
    {
        $query = Reporte::query();

        if ($this->pacienteId !== null) {
            $query->where('paciente_id', $this->pacienteId);
        }

        return $query;
    }
}
