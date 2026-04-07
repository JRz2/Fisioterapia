<?php

namespace App\Livewire;

use App\Models\Imgsesion;
use App\Models\Sesion;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SesionCreate extends Component
{
    use WithFileUploads;

    public $consultaId;

    public $codigo,
        $fecha,
        $sintoma,
        $observacion,
        $recomendacion,
        $tratamiento;

    public $opencreate = false;
    public $sesion;
    public $imagenkey;
    public $image;
    public $imagenes = [];
    public $ruta = [];
    public $postura_inicial = []; // Posición inicial de la mano
    public $postura_final = [];
    public $coordenadas;  // Posición final de la mano

    public $rodilla_d_flexion;
    public $rodilla_d_extension;
    public $rodilla_i_flexion;
    public $rodilla_i_extension;

    public $cadera_d_flexion;
    public $cadera_d_extension;
    public $cadera_d_abduccion;
    public $cadera_d_aduccion;
    public $cadera_d_rot_ext;
    public $cadera_d_rot_int;
    
    public $cadera_i_flexion;
    public $cadera_i_extension;
    public $cadera_i_abduccion;
    public $cadera_i_aduccion;
    public $cadera_i_rot_ext;
    public $cadera_i_rot_int;

    public $hombro_d_flexion;
    public $hombro_d_extension;
    public $hombro_d_abduccion;
    public $hombro_d_rot_ext;
    public $hombro_d_rot_int;
    
    public $hombro_i_flexion;
    public $hombro_i_extension;
    public $hombro_i_abduccion;
    public $hombro_i_rot_ext;
    public $hombro_i_rot_int;
    
     public $codo_d_flexion;
    public $codo_d_extension;
    public $codo_i_flexion;
    public $codo_i_extension;

    public $muneca_d_flexion;
    public $muneca_d_extension;
    public $muneca_d_radial;
    public $muneca_d_cubital;
    
    public $muneca_i_flexion;
    public $muneca_i_extension;
    public $muneca_i_radial;
    public $muneca_i_cubital;

     public $tobillo_d_dorsiflexion;
    public $tobillo_d_flexion_plantar;
    public $tobillo_d_inversion;
    public $tobillo_d_eversion;
    
    public $tobillo_i_dorsiflexion;
    public $tobillo_i_flexion_plantar;
    public $tobillo_i_inversion;
    public $tobillo_i_eversion;

    public $cervical_flexion;
    public $cervical_extension;
    public $cervical_rotacion_izq;
    public $cervical_rotacion_der;
    public $cervical_inclinacion_izq;
    public $cervical_inclinacion_der;
    
 public $lumbar_flexion;
    public $lumbar_extension;
    public $lumbar_rotacion_izq;
    public $lumbar_rotacion_der;
    public $lumbar_inclinacion_izq;
    public $lumbar_inclinacion_der;

    public function create()
    {
        $this->resetValidation();
        $this->opencreate = true;
    }

    public function save()
    {
        $this->validate([
            'fecha' => 'required',
        ]);

        $lastSesion = Sesion::where('consulta_id', $this->consultaId)
            ->orderBy('codigo', 'desc')
            ->first();

        if ($lastSesion) {
            $lastCode = intval(substr($lastSesion->codigo, 1));
            $newCode = $lastCode + 1;
        } else {
            $newCode = 1;
        }

        $codigo = 'S' . str_pad($newCode, 3, '0', STR_PAD_LEFT);


        $datosBiomecanicos = [
            // FECHA DE MEDICIÓN
            'fecha_medicion' => now()->toISOString(),
            
            // ===== RODILLAS =====
            'rodilla' => [
                'derecha' => [
                    'flexion' => $this->rodilla_d_flexion ?? null,
                    'extension' => $this->rodilla_d_extension ?? null,
                ],
                'izquierda' => [
                    'flexion' => $this->rodilla_i_flexion ?? null,
                    'extension' => $this->rodilla_i_extension ?? null,
                ],
            ],
            
            // ===== CADERAS =====
            'cadera' => [
                'derecha' => [
                    'flexion' => $this->cadera_d_flexion ?? null,
                    'extension' => $this->cadera_d_extension ?? null,
                    'abduccion' => $this->cadera_d_abduccion ?? null,
                    'rotacion_externa' => $this->cadera_d_rot_ext ?? null,
                    'rotacion_interna' => $this->cadera_d_rot_int ?? null,
                ],
                'izquierda' => [
                    'flexion' => $this->cadera_i_flexion ?? null,
                    'extension' => $this->cadera_i_extension ?? null,
                    'abduccion' => $this->cadera_i_abduccion ?? null,
                    'rotacion_externa' => $this->cadera_i_rot_ext ?? null,
                    'rotacion_interna' => $this->cadera_i_rot_int ?? null,
                ],
            ],
            
            // ===== HOMBROS =====
            'hombro' => [
                'derecha' => [
                    'flexion' => $this->hombro_d_flexion ?? null,
                    'extension' => $this->hombro_d_extension ?? null,
                    'abduccion' => $this->hombro_d_abduccion ?? null,
                    'rotacion_externa' => $this->hombro_d_rot_ext ?? null,
                    'rotacion_interna' => $this->hombro_d_rot_int ?? null,
                ],
                'izquierda' => [
                    'flexion' => $this->hombro_i_flexion ?? null,
                    'extension' => $this->hombro_i_extension ?? null,
                    'abduccion' => $this->hombro_i_abduccion ?? null,
                    'rotacion_externa' => $this->hombro_i_rot_ext ?? null,
                    'rotacion_interna' => $this->hombro_i_rot_int ?? null,
                ],
            ],
            
            // ===== CODOS =====
            'codo' => [
                'derecha' => [
                    'flexion' => $this->codo_d_flexion ?? null,
                    'extension' => $this->codo_d_extension ?? null,
                ],
                'izquierda' => [
                    'flexion' => $this->codo_i_flexion ?? null,
                    'extension' => $this->codo_i_extension ?? null,
                ],
            ],
            
            // ===== MUÑECAS =====
            'muneca' => [
                'derecha' => [
                    'flexion' => $this->muneca_d_flexion ?? null,
                    'extension' => $this->muneca_d_extension ?? null,
                    'desviacion_radial' => $this->muneca_d_radial ?? null,
                    'desviacion_cubital' => $this->muneca_d_cubital ?? null,
                ],
                'izquierda' => [
                    'flexion' => $this->muneca_i_flexion ?? null,
                    'extension' => $this->muneca_i_extension ?? null,
                    'desviacion_radial' => $this->muneca_i_radial ?? null,
                    'desviacion_cubital' => $this->muneca_i_cubital ?? null,
                ],
            ],
            
            // ===== TOBILLOS =====
            'tobillo' => [
                'derecha' => [
                    'dorsiflexion' => $this->tobillo_d_dorsiflexion ?? null,
                    'flexion_plantar' => $this->tobillo_d_flexion_plantar ?? null,
                    'inversion' => $this->tobillo_d_inversion ?? null,
                    'eversion' => $this->tobillo_d_eversion ?? null,
                ],
                'izquierda' => [
                    'dorsiflexion' => $this->tobillo_i_dorsiflexion ?? null,
                    'flexion_plantar' => $this->tobillo_i_flexion_plantar ?? null,
                    'inversion' => $this->tobillo_i_inversion ?? null,
                    'eversion' => $this->tobillo_i_eversion ?? null,
                ],
            ],
            
            // ===== COLUMNA =====
            'columna' => [
                'cervical' => [
                    'flexion' => $this->cervical_flexion ?? null,
                    'extension' => $this->cervical_extension ?? null,
                    'rotacion_izquierda' => $this->cervical_rotacion_izq ?? null,
                    'rotacion_derecha' => $this->cervical_rotacion_der ?? null,
                    'inclinacion_izquierda' => $this->cervical_inclinacion_izq ?? null,
                    'inclinacion_derecha' => $this->cervical_inclinacion_der ?? null,
                ],
                'lumbar' => [
                    'flexion' => $this->lumbar_flexion ?? null,
                    'extension' => $this->lumbar_extension ?? null,
                    'rotacion_izquierda' => $this->lumbar_rotacion_izq ?? null,
                    'rotacion_derecha' => $this->lumbar_rotacion_der ?? null,
                    'inclinacion_izquierda' => $this->lumbar_inclinacion_izq ?? null,
                    'inclinacion_derecha' => $this->lumbar_inclinacion_der ?? null,
                ],
            ],
        ];

        $sesion = Sesion::create([
            'fecha' => $this->fecha,
            'consulta_id' => $this->consultaId,
            'codigo' => $codigo,
            'sintoma' => $this->sintoma,
            'observacion' => $this->observacion,
            'recomendacion' => $this->recomendacion,
            'tratamiento' => $this->tratamiento,
            'datos_biomecanicos' => json_encode($datosBiomecanicos),
        ]);

        if ($this->ruta) {
            foreach ($this->ruta as $img) {
                $path = $img->store('sesions', 'public');

                Imgsesion::create([
                    'sesion_id' => $sesion->id,
                    'ruta' => $path,
                ]);
            }
        }

        $this->dispatch('sesion-created');
        $this->opencreate = false;
        $this->reset(['fecha', 'sintoma', 'observacion', 'recomendacion', 'tratamiento']);
        $this->reset([
            'rodilla_d_flexion', 'rodilla_d_extension',
            'rodilla_i_flexion', 'rodilla_i_extension',
            'cadera_d_flexion', 'cadera_d_extension', 'cadera_d_abduccion', 'cadera_d_rot_ext', 'cadera_d_rot_int',
            'cadera_i_flexion', 'cadera_i_extension', 'cadera_i_abduccion', 'cadera_i_rot_ext', 'cadera_i_rot_int',
            'hombro_d_flexion', 'hombro_d_extension', 'hombro_d_abduccion', 'hombro_d_rot_ext', 'hombro_d_rot_int',
            'hombro_i_flexion', 'hombro_i_extension', 'hombro_i_abduccion', 'hombro_i_rot_ext', 'hombro_i_rot_int',
            'codo_d_flexion', 'codo_d_extension',
            'codo_i_flexion', 'codo_i_extension',
            'muneca_d_flexion', 'muneca_d_extension', 'muneca_d_radial', 'muneca_d_cubital',
            'muneca_i_flexion', 'muneca_i_extension', 'muneca_i_radial', 'muneca_i_cubital',
            'tobillo_d_dorsiflexion', 'tobillo_d_flexion_plantar', 'tobillo_d_inversion', 'tobillo_d_eversion',
            'tobillo_i_dorsiflexion', 'tobillo_i_flexion_plantar', 'tobillo_i_inversion', 'tobillo_i_eversion',
            'cervical_flexion', 'cervical_extension', 'cervical_rotacion_izq', 'cervical_rotacion_der',
            'cervical_inclinacion_izq', 'cervical_inclinacion_der',
            'lumbar_flexion', 'lumbar_extension', 'lumbar_rotacion_izq', 'lumbar_rotacion_der',
            'lumbar_inclinacion_izq', 'lumbar_inclinacion_der'
        ]);
    }


    public function keyrand()
    {
        $this->imagenkey = rand();
    }


    public function render()
    {
        return view('livewire.sesion-create');
    }

    public function mount()
    {
        date_default_timezone_set('America/La_Paz');
        $this->fecha = Carbon::now()->toDateString();
    }
    /*protected $listeners = [
        'updatePosturaInicial' => 'setPosturaInicial',
        'updatePosturaFinal' => 'setPosturaFinal',
    ];*/

    protected $listeners = [
        'updatePosturaInicial',
        'updatePosturaFinal'
    ];
    
    public function updatePosturaInicial($postura)
    {
        $json = json_encode($postura);
        $this->postura_inicial = $json; 
        $this->dispatch('swal:confirm', [
            'title' => 'Postura Inicial '.$json.' ',
            'text' => '¿Estas seguro de eliminarlo?',
            'confirmButtonText' => 'Sí, Eliminar',
            'cancelButtonText' => 'Cancelar',
            'data' => $json
        ]);
    }
    
    public function updatePosturaFinal($postura)
    { 
        $json1 = json_encode($postura);
        $this->postura_final = $json1;
        $this->dispatch('swal:confirm', [
            'title' => 'Postura final',
            'text' => '¿Estas seguro de eliminarlo?',
            'confirmButtonText' => 'Sí, Eliminar',
            'cancelButtonText' => 'Cancelar',
            'data' => $json1
        ]); // Acceder al valor enviado desde el frontend
    }
}
