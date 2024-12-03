<?php

namespace App\Livewire;

use App\Models\Consulta;
use App\Models\Paciente;
use Livewire\Component;
use Carbon\Carbon;

class NewConsulta extends Component
{
    public $codigo;
    public $fecha;
    public $pacienteId;
    public $opencreate = false;
    public $cerrar = true;
    public $btnterminar = false;
    public $panel = false;
    public $ultima_consulta;

    public function create(){
        $this->resetValidation();
        $this->opencreate = true;
    }

    public function save(){
        $this->validate([
            'fecha' => 'required',
        ],[
            'fecha' => 'La fecha es requerida',
        ]);

        $paciente = Paciente::find($this->pacienteId);


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
        $consulta->paciente_id = $this->pacienteId;
        $consulta->fecha = $this->fecha;
        $consulta->codigo = $nuevoCodigo;
        $consulta->save();

        $this->reset(['codigo','fecha']);
        $this->cerrar = false;
        $this->btnterminar = true;
        $this-> panel = true;

        $this->ultima_consulta = Consulta::where('paciente_id', $consulta->paciente_id)
        ->latest()
        ->first();
        
        $this->dispatch('swal:loading', [
            'title' => 'Generando consulta',
            'text' => 'Por favor espere...',
            'icon' => 'info',
        ]);
        
        return redirect()->route('doctor.consulta.create', ['id' => $consulta->id]);
    }

    public function render()
    {
        //dd($this->pacienteId);
        $this->fecha = Carbon::now()->toDateString(); 
        $paciente = Paciente::find($this->pacienteId);
        return view('livewire.new-consulta', compact('paciente'));
    }
}
