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

class PetsittingRefusedRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public User $owner;
    public User $petsitter;
    public Pet $pet;
    public PetSittingRequest $petsittingRequest;
    public function __construct(User $owner, User $petsitter, Pet $pet, PetSittingRequest $petsittingRequest)
    {
        $this->owner = $owner;
        $this->petsitter = $petsitter;
        $this->pet = $pet;
        $this->petsittingRequest = $petsittingRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre demande de garde n’a pas été acceptée ',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.petsitting-refused-request',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
