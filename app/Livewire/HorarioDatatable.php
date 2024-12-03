<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Horario;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class HorarioDatatable extends DataTableComponent
{
    protected $model = Horario::class;
    public $pacienteId;
    protected $listeners = ['destroy'];
    public $horariostabla;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setPerPageAccepted([5, 10, 15, 25, 50, 100]);
        $this->setPerPage(10);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Consulta", "consulta.codigo")
                ->sortable(),
            Column::make("Dia", "dia")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Hora", "hora_inicio")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Fecha", "fecha_inicio")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Estado", "estado")
            ->label(
                fn($row) => $row->calcularEstado()
            )->sortable()->searchable(),
            Column::make("Acciones")->collapseOnTablet()->sortable()->searchable()
                ->label(
                    fn($row) => view('livewire.horario-actions', compact('row'))
                ),
        ];
    }

    public function builder(): Builder
    {
        $query = Horario::query();

        if ($this->pacienteId !== null) {
            $query->whereHas('consulta', function ($consultaQuery) {
                $consultaQuery->where('paciente_id', $this->pacienteId);
            });
        }
    
        return $query;
        return Horario::with('sesiones', 'consulta');
    }

    public function editHorario($data){
        $this->dispatch('editHorario', [$data]); 
    }

    public function confirm($dataHorario)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'SESION' .' '. $dataHorario['dia'] . ' ' . $dataHorario['fecha_inicio'],
            'text' => '¿Estas seguro de eliminarlo?',
            'confirmButtonText' => 'Sí, Eliminar',
            'cancelButtonText' => 'Cancelar',
            'data' => $dataHorario
        ]);
    }

    public function destroy($id)
    {
        $paciente = Horario::find($id);
        $paciente->delete();
        $this->dispatch('swal:success', [
            'title' => 'Sesion',
            'text' => 'Eliminado Correctamente',
        ]);
    }

    #[On('horario-update')]
    public function actualizarTabla()
    {
        $this->horariostabla = $this->getPacientes();
    }

    private function getPacientes()
    {

    }
}
