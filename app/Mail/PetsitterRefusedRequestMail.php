<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PetsitterRefusedRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $petsitter;
    public function __construct(User $petsitter)
    {
        $this->petsitter = $petsitter;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Désolée votre demande n’a pas été acceptée',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.petsitter-refused-request',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
