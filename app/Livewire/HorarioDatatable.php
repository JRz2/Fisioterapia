<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Horario;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Illuminate\Support\HtmlString;

class HorarioDatatable extends DataTableComponent
{
    protected $model = Horario::class;
    public $pacienteId;
    protected $listeners = ['destroy'];
    public $horariostabla;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setSearchStatus(false);
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setPerPageAccepted([10, 15, 25, 50, 100]);
        $this->setPerPage(10);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
           // Column::make("Consulta", "consulta.codigo")
                //->sortable(),
            Column::make("Dia", "dia")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Hora", "hora_inicio")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Fecha", "fecha_inicio")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Estado", "estado")
            ->collapseOnTablet()
            ->sortable()
            ->searchable()
            ->label(function ($row) {
                $estado = $row->estado === 1 ? 'Completado' : 'Pendiente';
                $color = $row->estado === 1 ? 'bg-success' : 'bg-warning';
                return new HtmlString("<span class='badge {$color}'>{$estado}</span>");
            }),
            Column::make("Acciones")->collapseOnTablet()->sortable()->searchable()
                ->label(
                    fn($row) => view('livewire.horario-actions', compact('row'))
                ),
        ];
    }

    
    public function builder(): Builder
    {
        $query = Horario::with('sesiones', 'consulta')
        ->select('horarios.id', 'horarios.estado', 'horarios.dia', 'horarios.hora_inicio', 'horarios.fecha_inicio', 'horarios.consulta_id', 'consultas.codigo')
        ->leftJoin('consultas', 'consultas.id', '=', 'horarios.consulta_id');
        
        //$query = Horario::query();
        if ($this->pacienteId !== null) {
            $query->whereHas('consulta', function ($consultaQuery) {
                $consultaQuery->where('paciente_id', $this->pacienteId);
            });
        }
        //dd($query->get());
        return $query;
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
