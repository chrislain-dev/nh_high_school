<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail']; // Notifications stockées et envoyées par mail
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvel utilisateur ajouté')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Un nouvel utilisateur a été ajouté au système.')
            ->line('Nom: ' . $this->user->name)
            ->line('Email: ' . $this->user->email)
            ->action('Voir l\'utilisateur', url('/admin/users/' . $this->user->id))
            ->line('Merci de vérifier cette information.');
    }

    /**
     * Get the array representation of the notification for database storage.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Un nouvel utilisateur a été ajouté : ' . $this->user->name,
            'user_id' => $this->user->id,
        ];
    }
}
