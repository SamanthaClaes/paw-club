<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PetsitterMessageMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public User $petsitter;
    public array $data;

    public function __construct( User $petsitter, array $data)
    {
        $this->petsitter = $petsitter;
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau message d’un propriétaire',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.petsitter-message',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
