<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewTutorAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    /**
     * Crée une nouvelle instance du message.
     *
     * @param mixed $user L'utilisateur nouvellement créé
     * @param string $password Le mot de passe généré
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Retourne l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue sur notre plateforme',
        );
    }

    /**
     * Définie le contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new_tutor_added',
            with: [
                'user'     => $this->user,
                'password' => $this->password,
            ]
        );
    }

    /**
     * Retourne les pièces jointes pour le message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
