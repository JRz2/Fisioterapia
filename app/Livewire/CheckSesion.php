<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Horario;
use App\Notifications\SessionReminder;

class CheckSesion extends Component
{   

    public $sessionsToday = [];

    public function mount()
    {
        $today = now()->toDateString();
    
        // Recuperar los horarios del día con sus relaciones
        $this->sessionsToday = Horario::with('consulta.paciente')
            ->where('fecha_inicio', $today) // Fecha de inicio válida
            ->get();
            //dd($today);
            //dd($this->sessionsToday);
    }
    

    /*public function mount()
    {
        $today = Carbon::now()->toDateString();
        $this->sessionsToday = Horario::where('fecha_inicio', $today)->get();
       // dd($today);
        //dd($this->sessionsToday);
    }*/

    public function render()
    {
        return view('livewire.check-sesion');
    }
}
