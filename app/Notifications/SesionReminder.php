<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SesionReminder extends Notification
{
    use Queueable;
    public $horario;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->shorario = $horario;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Tienes una Sesion Programada para hoy.')
                    ->line('Día: ' . $this->horario->dia)
                    ->line('Hora: ' . $this->horario->hora_inicio)
                    ->line('Fecha: ' . $this->horario->fecha_inicio)
                    ->line('No lo olvides!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Tienes una sesión programada para hoy.',
            'dia' => $this->horario->dia,
            'hora' => $this->horario->hora_inicio,
            'fecha' => $this->horario->fecha_inicio
        ];
    }
}
