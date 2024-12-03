<?php

namespace App\Livewire;

use App\Models\Imgsesion;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sesion;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class SesionDatatable extends DataTableComponent
{
    public $sesions;
    public $sesionstabla;
    public $consultaId;
    public $sesion;

    protected $model = Sesion::class;

    public $view = 'livewire.sesion-datatable';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setSearchStatus(false);
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setPerPageAccepted([5, 10, 15, 25, 50, 100]);
        $this->setPerPage(5);
    }

    public function columns(): array
    {   
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Codigo", "Codigo")
                ->sortable(),
            Column::make("Fecha", "fecha")
                ->sortable(),
            Column::make("Acciones")
                ->collapseOnTablet()
                ->label(
                    function($row) {
                        return view('livewire.index-sesion', [
                            'row' => $row,
                        ]);
                    }
                ),
        ];
    }

    public function mount(Sesion $sesion){
        $this->sesionstabla = $this->getSesions();
        $this->sesion = $sesion;
    }

    #[On('sesion-created')]
    public function actualizarTabla(){
        $this->sesionstabla = $this->getSesions();
    } 

    private function getSesions(){
 
    }


    public function builder(): Builder
    {
        $query = Sesion::query();

        if ($this->consultaId !== null) {
            $query->where('consulta_id', $this->consultaId);
        }

        return $query;
    }


    public $open = false;
    public $openshow = false;
    public $sesion_edit_id;
    public $fecha;
    public $sintoma;
    public $observacion;
    public $recomendacion;
    public $tratamiento;
    public $sesionimg;
    public $ruta;

    public function edit($sesionId){
        $this->resetValidation();
        $this->open = true;
        $sesion = Sesion::find($sesionId);
        $this->sesion_edit_id = $sesion->id;
        $this->fecha = $sesion->fecha;
        $this->sintoma = $sesion->sintoma; 
        $this->observacion = $sesion->observacion;
        $this->recomendacion = $sesion->recomendacion; 
        $this->tratamiento = $sesion->tratamiento; 
    }

    public function show($sesionId){
        $this->resetValidation();
        $this->openshow = true;
        $sesion = Sesion::find($sesionId);
        $this->sesion_edit_id = $sesion->id;
        $this->fecha = $sesion->fecha;
        $this->sintoma = $sesion->sintoma; 
        $this->observacion = $sesion->observacion;
        $this->recomendacion = $sesion->recomendacion; 
        $this->tratamiento = $sesion->tratamiento; 

      //  $imgsesion = Imgsesion::find($sesionId);
        //$this->ruta = $imgsesion->ruta;
    }
}
