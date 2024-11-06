<?php

namespace App\Livewire;

use App\Models\Antropometria;
use App\Models\Consulta;
use Livewire\Component;

class AntropometriaCreate extends Component
{
    public $talla, $peso, $imc, $pi,
        $pa, $sp, $fc;
    public $categoriaPeso ="";
    public $colorCategoriaPeso;
    public $ultimaConsultaId;
    public $consulta_id;
    public $consultaId;
    public $editMode = false;

    public function mount($consultaId){
        $this->consultaId = $consultaId;
        $an = Antropometria::where('consulta_id',$this->consultaId)->first();
        if ($an){
            $this->talla = $an->talla;
            $this->peso = $an->peso;
            $this->imc = $an->imc;
            $this->pi = $an->pi;
            $this->pa = $an->pa;
            $this->sp = $an->sp;
            $this->fc = $an->fc;
            $this->editMode = true;
        }
    }
    
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
    

    public function save()
    {
        if ($this->editMode){
            $an = Antropometria::where('consulta_id', $this->consultaId)->first();
            $an->update([
                'talla' => $this->talla,
                'peso' => $this->peso,
                'imc' => $this->imc,
                'pe' => $this->pi,
                'pa' => $this->pa,
                'sp' => $this->sp,
                'fc' => $this->fc,
            ]);
            $this->dispatch('swal:success', [
                'title' => 'Antropometria',
                'text' => 'Actualizado Correctamente',
            ]);
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
            $this->dispatch('swal:success', [
                'title' => 'Antropometria',
                'text' => 'Creado Correctamente',
            ]);
            $this->editMode = true;
        }
    }    

    public function validateNavBar($data)
    {
        $this->dispatch('confirmValidate', [$data]);
    }

    public function render()
    {       
        return view('livewire.antropometria-create');
    }

}
