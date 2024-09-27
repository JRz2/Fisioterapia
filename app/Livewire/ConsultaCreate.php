<?php

namespace App\Livewire;

use App\Models\Consulta;
use App\Models\Paciente;
use Carbon\Carbon;
use Livewire\Component;

class ConsultaCreate extends Component
{   
    public $paciente;
    public $pacientelive;
    public $codigo;
    public $fecha;
    public $paciente_id;
    public $ultima_consulta;
    public $consultaId;

    public $openan = true;
    public $openantro = false;
    public $openval = false;
    public $openins = false;
    public $openmov = false;
    public $openexa = false;
    public $opendiag = false;
    public $openplan = false;
    public $cerrar = true;
    public $btnterminar = true;
    public $panel = true;

    public function ananmesis(){
        $this->openan = true;
        $this->openantro = false;
        $this->openval = false;
        $this->openins = false;
        $this->openmov = false;
        $this->openexa = false;
        $this->opendiag = false;
        $this->openplan = false;
    }

    //#[On('anamnesis-created')]
    public function antropometria(){
        $this->openan = false;
        $this->openantro = true;
        $this->openval = false;
        $this->openins = false;
        $this->openmov = false;
        $this->openexa = false;
        $this->opendiag = false;
        $this->openplan = false;
    }

    public function evaluacion(){
        $this->openan = false;
        $this->openantro = false;
        $this->openval = true;
        $this->openins = false;
        $this->openmov = false;
        $this->openexa = false;
        $this->opendiag = false;
        $this->openplan = false;
    }

    public function inspeccion(){
        $this->openan = false;
        $this->openantro = false;
        $this->openval = false;
        $this->openins = true;
        $this->openmov = false;
        $this->openexa = false;
        $this->opendiag = false;
        $this->openplan = false;
    }

    public function movilizacion(){
        $this->openan = false;
        $this->openantro = false;
        $this->openval = false;
        $this->openins = false;
        $this->openmov = true;
        $this->openexa = false;
        $this->opendiag = false;
        $this->openplan = false;
    }

    public function examen(){
        $this->openan = false;
        $this->openantro = false;
        $this->openval = false;
        $this->openins = false;
        $this->openmov = false;
        $this->openexa = true;
        $this->opendiag = false;
        $this->openplan = false;
    }

    public function diagnostico(){
        $this->openan = false;
        $this->openantro = false;
        $this->openval = false;
        $this->openins = false;
        $this->openmov = false;
        $this->openexa = false;
        $this->opendiag = true;
        $this->openplan = false;
    }

    public function prueba(){
        $this->openan = false;
        $this->openantro = false;
        $this->openval = false;
        $this->openins = false;
        $this->openmov = false;
        $this->openexa = true;
        $this->opendiag = false;
        $this->openplan = false;
    }


    public function save(){
        $this->validate([
            'fecha' => 'required',
        ],[
            'fecha' => 'La fecha es requerida',
        ]);

        $paciente = Paciente::find($this->paciente_id);


        $iniciales = strtoupper(substr($paciente->nombre, 0, 1) . substr($paciente->paterno, 0, 1));
        $ultimoCodigo = Consulta::where('codigo', 'LIKE', $iniciales . '%')
            ->orderBy('codigo', 'desc')
            ->first();
        if ($ultimoCodigo) {
            $ultimoNumero = (int)substr($ultimoCodigo->codigo, 2);
            $nuevoNumero = $ultimoNumero + 1;
        } else {
            $nuevoNumero = 1;
        }
        $nuevoCodigo = $iniciales . str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);

        

        $consulta = new Consulta();
        $consulta->paciente_id = $this->paciente_id;
        $consulta->fecha = $this->fecha;
        $consulta->codigo = $nuevoCodigo;
        //$consulta->codigo = $codigo;
        $consulta->save();
        $this->reset(['paciente_id','codigo','fecha']);
        $this->cerrar = false;
        $this->btnterminar = true;
        $this-> panel = true;

        $this->ultima_consulta = Consulta::where('paciente_id', $consulta->paciente_id)
        ->latest()
        ->first();
    }

    public function mount(){
        //dd($this->consultaId);
        $consulta = Consulta::find($this->consultaId);
        $paciente = $consulta->paciente;
        $this->paciente = $paciente;
        //dd($paciente);
        //$pacienteId = $request->query('paciente');
        //dd($pacienteId);
        // $this->paciente = Paciente::findOrFail($pacienteId);
        // $this->paciente_id = $this->pacienteId;
        date_default_timezone_set('America/La_Paz');
        $this->fecha = Carbon::now()->toDateString();

        //$this->ultima_consulta = Consulta::where('paciente_id', $this->paciente_id)
        $this->ultima_consulta = Consulta::where('paciente_id', $consulta->paciente_id)
        ->latest()
        ->first()?? new Consulta;;
    }

    public function render()
    { 
        return view('livewire.consulta-create');
    }
}
