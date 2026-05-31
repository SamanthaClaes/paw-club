<?php

namespace App\Mail;

use App\Models\Pet;
use App\Models\PetSittingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ModifyPetsittingRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public PetSittingRequest $petSittingRequest;


    public function __construct( PetSittingRequest $petSittingRequest)
    {
        $this->petSittingRequest = $petSittingRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Modify Petsitting Request',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.modify-petsitting-request',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
