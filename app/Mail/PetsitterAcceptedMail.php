<?php

namespace App\Mail;

use AllowDynamicProperties;
use App\enum\UserRole;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

#[AllowDynamicProperties]
class PetsitterAcceptedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $petsitter;
    public string $token;

    public function __construct( User $petsitter,   string $token)
    {
        $this->petsitter = $petsitter;
        $this->token = $token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre demande à bien été acceptée',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.petsitter-accepted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
