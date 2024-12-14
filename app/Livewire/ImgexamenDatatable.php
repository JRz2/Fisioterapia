<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Imgexamen;
use Illuminate\Database\Eloquent\Builder;

class ImgexamenDatatable extends DataTableComponent
{
    protected $model = Imgexamen::class;
    protected $listeners = ['destroy', 'imgexamen-created' => 'actualizarTabla'];
    public $consultaId;
    public $imgexamenstabla;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Imagen", "ruta")->hideIf(true),
            Column::make("Imagen")->label(fn($row) => view('livewire.imgexamen-datatable', [
                'ruta' => asset('storage/app/public/'. $row->ruta), 
            ])),
            Column::make("Acciones")->collapseOnTablet()
                ->label(fn($row) => view('livewire.imgexamen-actions', compact('row'))),    
        ];
    }

    public function builder(): Builder
    {
        return Imgexamen::whereHas('examen', function ($query) {
            $query->where('consulta_id', $this->consultaId);
        });
    }
    
    public function mount(Imgexamen $imgexamen)
    {
        $this->imgexamenstabla = $this->getImgexamens();
        //$this->paciente = $paciente;
    }

    #[On('imgexamen-created')]
    public function actualizarTabla()
    {   
        $this->imgexamenstabla = $this->getImgexamens();
    }

    private function getImgexamens()
    {

    }

    public function confirm($dataImgexamen)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Imagen',
            'text' => '¿Estas seguro de eliminarlo?',
            'confirmButtonText' => 'Sí, Eliminar',
            'cancelButtonText' => 'Cancelar',
            'data' => $dataImgexamen
        ]);
    }

    public function destroy($id)
    {
        $imgexamen = Imgexamen::find($id);
        if ($imgexamen) {
            $imgexamen->delete();
            $this->dispatch('swal:success', [
                'title' => 'Imagen',
                'text' => 'Eliminado Correctamente',
            ]);
        } else {
            $this->dispatch('swal:error', [
                'title' => 'Error',
                'text' => 'No se pudo eliminar la imagen',
            ]);
        }
    }
}