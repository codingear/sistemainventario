<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Notifications\Messages\MailMessage;

class NewAdmin extends Notification
{
    use Queueable;
    public $newUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newUser)
    {
        $this->newUser = $newUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Registro en Equibra.com')
            ->greeting('Hola ' . $this->newUser->name)
            ->line('Has sido añadido(a) como ' . $this->newUser->roles->first()->name . ' en el sistema de Equibra.')
            ->line('Tus credenciales de acceso son: ')
            ->line('Email: ' . $this->newUser->email)
            ->line('Contraseña temporal: ' . $this->newUser->temp_pass)
            ->line('Al ingresar al sistema se te pedirá que igreses una contraseña nueva, "conservala en un lugar seguro" ya que una vez que hayas creado una nueva no podras ingresar con la contraseña temporal.')
            ->action('Ingresar al Sistema', url('/login'))
            ->salutation('¡Saludos!. El equipo de Equibra');
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
