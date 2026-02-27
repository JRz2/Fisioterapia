<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Imgconsulta;
use Illuminate\Support\Facades\URL;

class ModelViewer extends Component
{
    public $consultaId;         // id de la consulta cuyos modelos listamos
    public $imgconsultaId = null; // id del imgconsulta actualmente mostrado
    public $format = 'glb';
    public $signedUrlTtlMinutes = 30;

    protected $listeners = [
        'meshyModelReady' => 'refreshList', // opcional: si otro componente emite que llegó un modelo
    ];

    public function mount($consultaId = null)
    {
        $this->consultaId = $consultaId;
    }

        public function showModel($imgId)
    {
        $this->imgconsultaId = $imgId;
    }

    public function refreshList($imgId = null)
    {
        // Si se pasó un imgId, opcionalmente lo podemos auto-seleccionar:
        if ($imgId) {
            // no lo seleccionamos por defecto; el usuario decidirá con Mostrar
            // $this->imgconsultaId = $imgId;
        }
        $this->emitSelf('render'); // fuerza rerender si quieres
    }

    public function getModelSrcProperty()
    {
        if (! $this->imgconsultaId) {
            return null;
        }

        // Opción A: ruta proxy sin firma (dev)
        return route('meshy.model', ['imgconsulta' => $this->imgconsultaId, 'format' => $this->format]);

        // Opción B (recomendado para producción): ruta firmada temporal
        // return URL::temporarySignedRoute('meshy.model', now()->addMinutes($this->signedUrlTtlMinutes), [
        //     'imgconsulta' => $this->imgconsultaId,
        //     'format' => $this->format,
        // ]);
    }

   public function render()
    {
        $imagenes = [];
        if ($this->consultaId) {
            $imagenes = Imgconsulta::where('consulta_id', $this->consultaId)
                        ->orderBy('id', 'desc')
                        ->get();
        }

        $current = $this->imgconsultaId ? Imgconsulta::find($this->imgconsultaId) : null;
        $thumbnail = $current->meshy_result['thumbnail_url'] ?? null;

        return view('livewire.model-viewer', [
            'imagenes' => $imagenes,
            'current' => $current,
            'modelSrc' => $this->modelSrc,
            'thumbnail' => $thumbnail,
        ]);
    }
}
