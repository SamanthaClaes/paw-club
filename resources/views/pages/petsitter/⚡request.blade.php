<?php

use App\Enums\DayCareRequestStatus;
use App\Enums\PetsitterRequestStatus;
use App\Models\DayCareRequest;
use App\Models\PetSittingRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mes demandes')]
class extends Component {
    public $requests;
    public $refusedRequests;
    public $acceptedRequest;

    public function mount(): void
    {
        $this->requests = PetSittingRequest::with('animalType')->get();
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
            ->where('status', PetsitterRequestStatus::PENDING)
            ->get();

        $this->refusedRequests = PetSittingRequest::where(
            'status',
            PetsitterRequestStatus::REFUSED
        )
            ->where('petsitter_id', Auth::id())
            ->latest()
            ->get();

        $this->acceptedRequest = PetSittingRequest::where( 'status' , PetsitterRequestStatus::ACCEPTED)
            ->where('petsitter_id', Auth::id())
            ->latest()
            ->get();
    }

    public function acceptRequest($requestId): void
    {
        $request = PetSittingRequest::findOrFail($requestId);

        $request->status = PetsitterRequestStatus::ACCEPTED;

        $request->save();

        $this->loadPendingRequests();

        $request->refresh();
    }

    public function refusedRequest($requestId): void
    {
        $request = PetSittingRequest::findOrFail($requestId);
        $request->status = PetsitterRequestStatus::REFUSED;
        $request->save();
        $this->loadPendingRequests();
        $request->refresh();
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

                @forelse($acceptedRequest as $request)

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
