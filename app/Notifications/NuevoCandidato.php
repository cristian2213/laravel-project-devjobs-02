<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoCandidato extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vacanteTitulo, $vacanteId)
    {
        $this->vacanteTitulo = $vacanteTitulo;
        $this->vacanteId = $vacanteId;
    }

    /** 
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // habilitando notificaciones de tipo databese
    }

    /**
     * Get the mail representation of the notification.
     * notificacion de tipo email
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Has recibido un nuevo candidato en tu vacante')
            ->line('La vacante es: ' . $this->vacanteTitulo)
            ->action('Visita DevJobs', url('/'))
            ->line('Gracias por usar DevJobs!');
    }

    //* notificacion de tipo DB
    public function toDatabase($notifiable)
    {
        // lo que se le pase a este arreglo asociativo se va a guardar en la base de datos como un objeto
        return [
            'id' => $this->vacanteId,
            'vacante' => $this->vacanteTitulo
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
