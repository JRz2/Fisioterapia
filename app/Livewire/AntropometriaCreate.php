<?php

namespace App\Livewire;

use App\Models\Antropometria;
use App\Models\Consulta;
use App\Models\Signo;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class AntropometriaCreate extends Component
{
    public $talla,
        $peso,
        $imc,
        $pi,
        $pa,
        $sp,
        $fc;
    public $categoriaPeso ="";
    public $colorCategoriaPeso;
    public $ultimaConsultaId;
    public $consulta_id;
    public $consultaId;

    public function calcularIMC()
    {
        if ($this->talla > 0 && $this->peso > 0) {
            $this->imc = $this->peso / (($this->talla / 100) ** 2); // Fórmula para calcular el IMC
    
            // Determinar la categoría de peso
            if ($this->imc < 18.5) {
                $this->categoriaPeso = 'Bajo';
                $this->colorCategoriaPeso = 'warning'; // Clase de Bootstrap para color amarillo
            } elseif ($this->imc >= 18.5 && $this->imc <= 24.9) {
                $this->categoriaPeso = 'Normal';
                $this->colorCategoriaPeso = 'success'; // Clase de Bootstrap para color verde
            } elseif ($this->imc >= 25 && $this->imc <= 29.9) {
                $this->categoriaPeso = 'Sobrepeso';
                $this->colorCategoriaPeso = 'primary'; // Clase de Bootstrap para color naranja
            } else {
                $this->categoriaPeso = 'Obeso';
                $this->colorCategoriaPeso = 'danger'; // Clase de Bootstrap para color rojo
            }
        } else {
            $this->imc = null; // Si la altura o el peso son cero o negativos, se establece el IMC como nulo
            $this->categoriaPeso = null;
        }
    }
    

    public function save(){
        //dd($this->consultaId);
        $existeantro = Antropometria::where('consulta_id',$this->consultaId)->first();
        if ($existeantro){
            $this->talla = $existeantro->talla;
            $this->peso = $existeantro->peso; 
            //dd("actualizar");
        }else{
            $antropometria = new Antropometria();
            $antropometria->consulta_id = $this->consultaId;
            $antropometria->talla = $this->talla;
            $antropometria->peso = $this->peso;
            $antropometria->imc = $this->imc;
            $antropometria->pi = $this->pi;
            $antropometria->pa = $this->pa;
            $antropometria->sp = $this->sp; 
            $antropometria->fc = $this->fc;
            $antropometria->save();
            //dd("guardar");
        }

        $ultimaConsulta = Consulta::latest('id')->first();
        $this->consulta_id = $ultimaConsulta->id;

    }    

    public function render()
    {       
        return view('livewire.antropometria-create');
    }

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $existeantro = Antropometria::where('consulta_id',$this->consultaId)->first();
        if ($existeantro){
            $this->talla = $existeantro->talla;
            $this->peso = $existeantro->peso;
        }
    }
}
