<?php

use App\Enums\PetsitterRequestStatus;
use App\Mail\PetsitterRequestMail;
use App\Mail\PetsittingAcceptedRequestMail;
use App\Mail\PetsittingRefusedRequestMail;
use App\Models\PetSittingRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mes demandes')]
class extends Component {
    public $requests;
    public $refusedRequests;
    public $acceptedRequests;

    public function mount(): void
    {
        $this->loadPendingRequests();
    }

    public function loadPendingRequests(): void
    {
        $this->requests = PetSittingRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed',
        ])
            ->where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::PENDING)
            ->latest()
            ->get();
        $this->requests->each(function ($request) {

            $request->previous_stays_count = PetSittingRequest::where('petsitter_id', $request->petsitter_id)
                ->where('pet_id', $request->pet_id)
                ->where('status', PetsitterRequestStatus::ACCEPTED)
                ->where('end_date', '<', now())
                ->count();

        });

        $this->refusedRequests = PetSittingRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed',
        ])
            ->where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::REFUSED)
            ->latest()
            ->get();

        $this->acceptedRequests = PetSittingRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed',
        ])
            ->where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->latest()
            ->get();
    }

    public function acceptRequest($requestId): void
    {
        $request = PetSittingRequest::with([
            'user',
            'petsitter',
            'pet',
        ])
            ->where('petsitter_id', Auth::id())
            ->findOrFail($requestId);

        $owner = $request->user;
        $petsitter = $request->petsitter;
        $pet = $request->pet;
        $request->status = PetsitterRequestStatus::ACCEPTED;
        $request->save();
        Mail::to($owner->email)->queue(new PetsittingAcceptedRequestMail($petsitter, $owner, $pet, $request));
        $this->loadPendingRequests();

    }

    public function pendingRequest($requestId): void
    {
        $request = PetSittingRequest::where('petsitter_id', Auth::id())
            ->with([
                'user',
                'petsitter',
                'pet',
            ])
            ->findOrFail($requestId);
        $request->status = PetsitterRequestStatus::PENDING;
        $request->save();
    }

    public function refusedRequest($requestId): void
    {
        $request = PetSittingRequest::with([
            'user',
            'petsitter',
            'pet',
        ])
            ->where('petsitter_id', Auth::id())
            ->findOrFail($requestId);

        $owner = $request->user;
        $petsitter = $request->petsitter;
        $pet = $request->pet;

        $request->status = PetsitterRequestStatus::REFUSED;
        $request->save();
        Mail::to($owner->email)->queue(new PetsittingRefusedRequestMail($owner, $petsitter, $pet, $request));
        $this->loadPendingRequests();
    }
};
?>

<div class="max-w-7xl mx-auto px-6 pb-20">

    <x-header.PetsitterNav/>

    <section class="mt-10">

        <h1 class="sr-only">
            L'espace du petsitter
        </h1>

        <div class="mb-20">

            <div class="flex items-center gap-4 mb-8">

                <h2 class="text-text uppercase text-3xl font-extrabold" id="pending">
                    Mes demandes en attente
                </h2>

            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($requests as $request)

                    <x-cards.animal_card_request_ps
                        :request="$request"
                    />

                @empty

                    <div class="bg-card border-2 border-element rounded-2xl p-8 w-full">

                        <p class="text-center text-text text-lg font-semibold">
                            Aucune demande en attente
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

        <div class="mb-20">

            <div class="flex items-center gap-4 mb-8">

                <h2 class="text-text uppercase text-3xl font-extrabold" id="accepted">
                    Mes demandes acceptées
                </h2>

            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($acceptedRequests as $request)

                    <x-cards.animal_card_request_ps
                        :request="$request"
                    />

                @empty

                    <div class="bg-card border-2 border-element rounded-2xl p-8 w-full">

                        <p class="text-center text-text text-lg font-semibold">
                            Aucune demande acceptée
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

        <div>

            <div class="flex items-center gap-4 mb-8">

                <h2 class="text-text uppercase text-3xl font-extrabold" id="refused">
                    Mes demandes refusées
                </h2>

            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($refusedRequests as $request)

                    <x-cards.animal_card_request_ps
                        :request="$request"
                    />

                @empty

                    <div class="bg-card border-2 border-element rounded-2xl p-8 w-full">

                        <p class="text-center text-text text-lg font-semibold">
                            Aucune demande refusée
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </section>

</div>
