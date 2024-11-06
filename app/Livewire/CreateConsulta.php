<?php

namespace App\Livewire;

use App\Models\Consulta;
use App\Models\Paciente;
use Livewire\Component;

class CreateConsulta extends Component
{   

    public $pacientes;
    public $selectedPaciente;
    public $pacienteSeleccionado;
    public $opencreate = false;
    public $paciente_id;
    public $nombre, $paterno, $materno;
    public $fecha;

    public function mount()
    {
        $this->pacientes = Paciente::all(); 
    }
    
    public function create()
    {
        $this->resetValidation();
        $this->opencreate = true;
    }

    public function save()
    {
        $this->validate([
            'paciente_id' => 'required',
            'fecha' => 'required',
        ],[
            'Paciente' => 'Paciente es requerido',
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
        $consulta->save();

        $this->reset(['paciente_id','fecha']);

        $this->dispatch('swal:loading', [
            'title' => 'Generando consulta',
            'text' => 'Por favor espere...',
            'icon' => 'info',
        ]);
        $this->opencreate = false;
        return redirect()->route('doctor.consulta.create', ['id' => $consulta->id]);
        
    }

    public function validateNavBar($data)
    {
        $this->dispatch('confirmValidate', [$data]);
    }

    public function render()
    {
        return view('livewire.create-consulta');
    }
}
