<?php

namespace App\Mail;

use App\Models\Pet;
use App\Models\PetSittingRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PetsittingAcceptedRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $owner;
    public User $petsitter;
    public Pet $pet;
    public PetSittingRequest $request;

    public function __construct( User $petsitter, User $owner, Pet $pet, PetSittingRequest $request)
    {
        $this->owner = $owner;
        $this->petsitter = $petsitter;
        $this->pet = $pet;
        $this->request = $request;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre demande de garde à été acceptée',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.petsitting-accepted-request',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
