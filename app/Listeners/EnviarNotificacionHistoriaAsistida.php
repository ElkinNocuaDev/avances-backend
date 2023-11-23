<?php

namespace App\Listeners;

use App\Events\HistoriaAsistida;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\HistoriaAsistidaNotification;

class EnviarNotificacionHistoriaAsistida implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  HistoriaAsistida  $event
     * @return void
     */
    public function handle(HistoriaAsistida $event)
    {
        // Aquí puedes obtener información del evento, por ejemplo, el usuario asociado a la historia.
        $usuario = $event->usuario;

        // Enviar notificación al usuario
        Notification::send($usuario, new HistoriaAsistidaNotification($event->historia));
    }
}
