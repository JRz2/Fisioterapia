<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Paciente;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class PacienteDatatable extends DataTableComponent
{
    use WithFileUploads;
    public $pacientes;
    public $paciente;
    public $pacientestabla;
    protected $model = Paciente::class;
    protected $listeners = ['destroy'];

    public $nombre,
        $paterno,
        $materno,
        $edad,
        $genero = "",
        $direccion,
        $deporte,
        $celular,
        $ocupacion;

    public $imagen;
    public $imagen3 = "hola";

    public $view = 'livewire.paciente-datatable';


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        $allColumns = [
            Column::make("Id", "id")->sortable()->collapseOnTablet()->searchable(),
            Column::make("Imagen", "imagen")->hideIf(true),
            Column::make("Imagen")->label(fn($row) => view('livewire.paciente-datatable', [
                'imagen' => strpos($row->imagen, 'image/') !== false 
                    ? asset($row->imagen) 
                    : asset('storage/app/public/'. $row->imagen),  
            ])),                       
            Column::make("Nombre", "nombre")->sortable()->searchable(),
            Column::make("Paterno", "paterno")->sortable()->searchable(),
            Column::make("Materno", "materno")->sortable()->searchable(),
            Column::make("CI", "ci")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Edad", "edad")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Genero", "genero")->collapseOnTablet()->sortable()->searchable(),
            Column::make("Acciones")->collapseOnTablet()->label(fn($row) => view('livewire.index-paciente', compact('row'))),
        ];
        return $allColumns;
    }

    public function mount(Paciente $paciente)
    {
        $this->pacientestabla = $this->getPacientes();
        $this->paciente = $paciente;
    }


    public function createUpdate($data){
        $this->dispatch('confirmUpdate', [$data]); 
    }

    public function save()
    {
        $this->paciente->save();
    }


    #[On('paciente-created')]
    public function actualizarTabla()
    {
        $this->pacientestabla = $this->getPacientes();
    }

    private function getPacientes()
    {
        //return Paciente::orderBy('id', 'desc')->get()->toArray();
        //return Paciente::all()->toArray();
    }

    public $open = false;

    public $pacienteEditId = '';

    public $paciente_edit_id;

    public function edit($pacienteId)
    {
        $this->resetValidation();
        $this->open = true;

        $paciente = Paciente::find($pacienteId);
        $this->paciente_edit_id = $paciente->id;
        $this->nombre = $paciente->nombre;
        $this->paterno = $paciente->paterno;
        $this->materno = $paciente->materno;
        $this->edad = $paciente->edad;
        $this->genero = $paciente->genero;
        $this->direccion = $paciente->direccion;
        $this->deporte = $paciente->deporte;
        $this->celular = $paciente->celular;
        $this->ocupacion = $paciente->ocupacion;
        $this->imagen = $paciente->imagen;
        //dd($this->imagen);
    }

    public function update()
    {
        /* $this->validate([
            'pacienteEdit.nombre' => 'required',
            'pacienteEdit.paterno' => 'required',
            'pacienteEdit.materno' => 'required',
            'pacienteEdit.edad' => 'required',
            'pacienteEdit.genero' => 'required',
        ],[
            'pacienteEdit.nombre' => 'Nombre requerido',
            'pacienteEdit.paterno' => 'Apellido Paterno requerido',
            'pacienteEdit.materno' => 'Apellido Materno requerido',
            'pacienteEdit.edad' => 'Edad requerido',
            'pacienteEdit.genero' => 'Genero requerido',
        ]);*/

        $paciente = Paciente::find($this->paciente_edit_id);
        $paciente->update([
            'nombre' => $this->nombre,
            'paterno' => $this->paterno,
            'materno' => $this->materno,
            'edad' => $this->edad,
            'genero' => $this->genero,
            'direccion' => $this->direccion,
            'deporte' => $this->deporte,
            'celular' => $this->celular,
            'ocupacion' => $this->ocupacion,
        ]);

        if ($this->imagen) {
            $paciente->imagen = $this->imagen->store('pacientes');
            $paciente->update();
        } else {
            $paciente->imagen = $paciente->imagen;
            $paciente->update();
        }

        $this->reset(['pacienteEditId', 'open']);
    }

    public function confirm($dataPaciente)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Paciente ' . $dataPaciente['nombre'] . ' ' . $dataPaciente['paterno']. ' ' . $dataPaciente['materno'],
            'text' => '¿Estas seguro de eliminarlo?',
            'confirmButtonText' => 'Sí, Eliminar',
            'cancelButtonText' => 'Cancelar',
            'data' => $dataPaciente
        ]);
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        $paciente->delete();
        $this->dispatch('swal:success', [
            'title' => 'Paciente',
            'text' => 'Eliminado Correctamente',
        ]);
    }
}
