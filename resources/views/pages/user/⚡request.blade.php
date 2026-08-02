<?php

use App\Enums\PetsitterRequestStatus;
use App\Mail\ModificationAcceptedRequestMail;
use App\Mail\ModificationRefuseRequestMail;
use App\Models\PetSittingRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mes demandes | Paw-club')]
class extends Component
{
    public $receivedModificationRequests = [];

    public function mount(): void
    {
        $this->loadReceivedModificationsRequests();
    }

    public function loadReceivedModificationsRequests(): void
    {
        $this->receivedModificationRequests = PetSittingRequest::with([
            'petsitter',
            'pet',
            'pet.breed',
            'pet.animalType',
        ])
            ->where('user_id', Auth::id())
            ->where('status', PetsitterRequestStatus::MODIFICATION_REQUESTED)
            ->get();
    }

    public function acceptModification($requestId): void
    {
        $request = PetSittingRequest::where('user_id', Auth::id())
            ->where('status', PetsitterRequestStatus::MODIFICATION_REQUESTED)
            ->findOrFail($requestId);

        $request->start_date = $request->requested_start_date;
        $request->end_date = $request->requested_end_date;
        $request->requested_start_date = null;
        $request->requested_end_date = null;
        $request->requested_description = null;
        $request->status = PetsitterRequestStatus::ACCEPTED;
        $request->save();

        Mail::to($request->petsitter->email)->queue(new ModificationAcceptedRequestMail($request));
        $this->loadReceivedModificationsRequests();
    }

    public function refuseModification($requestId): void
    {
        $request = PetSittingRequest::where('user_id', Auth::id())
            ->where('status', PetsitterRequestStatus::MODIFICATION_REQUESTED)
            ->findOrFail($requestId);

        $request->requested_start_date = null;
        $request->requested_end_date = null;
        $request->requested_description = null;
        $request->status = PetsitterRequestStatus::PENDING;
        $request->save();

        Mail::to($request->petsitter->email)
            ->queue(new ModificationRefuseRequestMail($request));

        $this->loadReceivedModificationsRequests();
    }

};
?>

<div>
    <div class="max-w-7xl mx-auto px-6">
        <x-header.UserNav/>

        <section class="mt-20">

            <h1 class="text-text lg:text-2xl text-lg uppercase font-bold mb-10">
                Mes demandes
            </h1>

            <div class="space-y-10">

                @forelse($receivedModificationRequests as $request)

                    <x-cards.cards_modify_request
                        :request="$request"
                    />

                @empty

                    <div class="bg-card border-2 border-element rounded-2xl p-8 mb-6">
                        Aucune modification en attente.
                    </div>

                @endforelse

            </div>

        </section>

    </div>
</div>
