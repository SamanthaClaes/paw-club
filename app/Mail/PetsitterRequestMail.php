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

class PetsitterRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $owner;
    public User $petsitter;
    public Pet $pet;
    public PetSittingRequest $petsittingRequest;

    public function __construct( User $owner, User $petsitter, Pet $pet, PetSittingRequest $petsittingRequest)
    {
        $this->owner = $owner;
        $this->petsitter = $petsitter;
        $this->pet = $pet;
        $this->petsittingRequest = $petsittingRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vous avez reçu une demande de garde',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.petsitter-request',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
