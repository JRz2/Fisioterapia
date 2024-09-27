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


    public $nombre, 
    $paterno, 
    $materno, 
    $edad, 
    $genero ="", 
    $direccion, 
    $deporte, 
    $celular, 
    $ocupacion;

    public $imagen;
    public $imagen3="hola";

    public $view = 'livewire.paciente-datatable';
    
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    { 
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "nombre")
                ->sortable(),
            Column::make("Paterno", "paterno")
                ->sortable(),
            Column::make("Celular", "celular")
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Deporte", "deporte")
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Edad", "edad")
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Acciones")
                ->collapseOnTablet()
                ->label(
                    fn($row) => view('livewire.index-paciente', compact('row'))
                ),

        ];
    }

    public function mount(Paciente $paciente){
        $this->pacientestabla = $this->getPacientes();
        $this->paciente = $paciente;
    }

    public function save(){ 
        $this->paciente->save();
    }
   

    #[On('paciente-created')]
    public function actualizarTabla(){
        $this->pacientestabla = $this->getPacientes();
    }   

    private function getPacientes(){
        //return Paciente::orderBy('id', 'desc')->get()->toArray();
        //return Paciente::all()->toArray();
    }

    public $open = false;
    
    public $pacienteEditId ='';

    public $paciente_edit_id;

    public function edit($pacienteId){
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

    public function update(){
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
        $paciente -> update([  
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

        if($this->imagen){
            $paciente->imagen = $this->imagen->store('pacientes');
            $paciente->update();
        }else {
            $paciente->imagen = $paciente->imagen;
            $paciente->update();
        }
        
        $this->reset(['pacienteEditId','open']);

    }

    public function destroy($pacienteId){
        $paciente = Paciente::find($pacienteId);
        $paciente->delete();
    }


}
