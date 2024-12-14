<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Horario;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Illuminate\Support\HtmlString;

class HorariosDatatable extends DataTableComponent
{
    protected $model = Horario::class;
    protected $listeners = ['destroy'];
    public $horariostabla;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
        Column::make("Id", "id")
            ->sortable(),
        Column::make("Paciente", "consulta.paciente.nombre")->sortable()->searchable(), 
        Column::make("Dia", "dia")->collapseOnTablet()->sortable()->searchable(),
        Column::make("Fecha", "fecha_inicio")->collapseOnTablet()->sortable()->searchable(),
        Column::make("Hora", "hora_inicio")->collapseOnTablet()->sortable()->searchable(),
        Column::make("Estado", "estado")->hideIf(true),
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

    public function editHorario($data){
        $this->dispatch('editHorario', [$data]); 
    }

    #[On('horario-update')]
    public function actualizarTabla()
    {
        $this->horariostabla = $this->getHorarios();
    }

    private function getHorarios()
    {

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
}
