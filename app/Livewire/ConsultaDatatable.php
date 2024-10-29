<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Consulta;

class ConsultaDatatable extends DataTableComponent
{
    protected $model = Consulta::class;
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
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Codigo", "codigo")
                ->sortable(),
            Column::make("Fecha", "fecha")
                ->sortable(),
            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.consulta-show', compact('row'))
                ),
        ];
    }   
    
    public function builder(): Builder
    {
        $query = Consulta::query();

        if ($this->pacienteId !== null) {
            $query->where('paciente_id', $this->pacienteId);
        }

        return $query;
    }

}
