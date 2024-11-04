<?php

namespace App\Livewire;

use App\Models\Consulta;
use App\Models\Reporte;
use Livewire\Component;

class InformeCreate extends Component
{
    public $consultaId;
    public $consulta;
    public $diagnostico;
    public $informe;
    public $rehabilitacion;
    public $recomendacion;
    public $nota;
    public $fecha;


    public $contenido;

    protected $listeners = ['contenidoActualizado' => 'updateContenido'];

    public function updateContenido($contenido)
    {
        $this->contenido = $contenido;
    }

    public function mount($consultaId)
    {
        $this->consulta = Consulta::find($consultaId);
    }

    public function save()
    {
        $informe = new Reporte();
        $informe->consulta_id = $this->consultaId;
        $informe->diagnostico = $this->diagnostico;
        $informe->informe = $this->informe;
        $informe->rehabilitacion = $this->rehabilitacion;
        $informe->recomendacion = $this->recomendacion;
        $informe->nota = $this->nota;
        $informe->fecha = $this->fecha ;
        $informe->save();
        $this->dispatch('swal:success', [
            'title' => 'Informe',
            'text' => 'Creado Correctamente',
        ]);
    }

    public function render()
    {
        return view('livewire.informe-create');
    }
}
