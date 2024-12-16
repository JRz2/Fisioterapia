<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Models\Horario;
use App\Notifications\SesionReminder;

class CheckSesion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;    
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $today = Carbon::now()->toDateString();
        $sessions = Horario::where('fecha', $today)->get();

        foreach ($sessions as $session) {
            // Asumiendo que tienes una relación entre 'Horario' y el usuario.
            $session->user->notify(new SessionReminder($session));
        }
    }
}
