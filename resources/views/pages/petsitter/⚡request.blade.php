<?php

use App\Enums\PetsitterRequestStatus;
use App\Mail\ModificationAcceptedRequestMail;
use App\Mail\ModificationCancelRequestMail;
use App\Mail\ModificationRefuseRequestMail;
use App\Mail\ModifyPetsittingRequestMail;
use App\Mail\PetsitterRequestMail;
use App\Mail\PetsittingAcceptedRequestMail;
use App\Mail\PetsittingRefusedRequestMail;
use App\Models\PetSittingRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mes demandes | Paw-club')]
class extends Component {
    public $requests;
    public $refusedRequests;
    public $acceptedRequests;
    public PetSittingRequest $request;
    public $requested_start_date;
    public $requested_end_date;
    public $start_date;
    public $end_date;
    public $requested_description;
    public $requestId;

    public $sentModificationRequests = [];
    public $receivedModificationRequests = [];

    public function mount(): void
    {
        $this->loadPendingRequests();
        $this->loadReceivedModificationRequests();
        $this->loadSentModificationRequest();
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


    public function loadReceivedModificationRequests(): void
    {
        $this->receivedModificationRequests = PetSittingRequest::with([
            'user',
            'pet',
            'pet.breed',
            'pet.animalType',
        ])
            ->where('user_id', Auth::id())
            ->where('status', PetsitterRequestStatus::MODIFICATION_REQUESTED)
            ->get();
    }

    public function loadSentModificationRequest(): void
    {
        $this->sentModificationRequests = PetSittingRequest::with([
            'user',
            'pet',
            'pet.breed',
            'pet.animalType',
        ])
            ->where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::MODIFICATION_REQUESTED)
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

    public function updateRequests(): void
    {
        $request = PetSittingRequest::with([
            'user',
            'petsitter',
            'pet',
        ])
            ->where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->findOrFail($this->requestId);

        $validated = $this->validate([
            'requested_start_date' => 'required|date',
            'requested_end_date' => 'required|date',
            'requested_description' => 'required|string',
        ]);

        $request->update($validated);
        $request->status = PetsitterRequestStatus::MODIFICATION_REQUESTED;
        $request->save();
        Mail::to($request->user->email)->queue(new ModifyPetsittingRequestMail($request));
        $this->loadPendingRequests();
        $this->dispatch('close-modify-modal');

    }

    public function acceptModification($requestId): void
    {
        $request = PetSittingRequest::where('user_id', Auth::id())
            ->where('status', PetsitterRequestStatus::MODIFICATION_REQUESTED)
            ->findOrFail($requestId);

        $request->start_date = $request->requested_start_date;
        $request->end_date = $request->requested_end_date;

        Mail::to($request->petsitter->email)->queue(new ModificationAcceptedRequestMail($request));
        $request->requested_start_date = null;
        $request->requested_end_date = null;
        $request->requested_description = null;

        $request->status = PetsitterRequestStatus::ACCEPTED;


        $request->save();

        $this->loadPendingRequests();
    }

    public function refuseModification($requestId): void
    {
        $request = PetSittingRequest::where('user_id', Auth::id())
            ->where('status', PetsitterRequestStatus::MODIFICATION_REQUESTED)
            ->findOrFail($requestId);

        Mail::to($request->petsitter->email)->queue(new ModificationRefuseRequestMail($request));

        $request->requested_start_date = null;
        $request->requested_end_date = null;
        $request->requested_description = null;

        $request->status = PetsitterRequestStatus::PENDING;

        $request->save();

        $this->loadSentModificationRequest();
        $this->loadReceivedModificationRequests();
    }

    public function cancelModification($requestId): void
    {
        $request = PetSittingRequest::where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::MODIFICATION_REQUESTED)
            ->findOrFail($requestId);

        Mail::to($request->user->email)->queue(new ModificationCancelRequestMail($request));

        $request->requested_start_date = null;
        $request->requested_end_date = null;
        $request->requested_description = null;

        $request->status = PetsitterRequestStatus::ACCEPTED;

        $request->save();

        $this->loadSentModificationRequest();
        $this->loadReceivedModificationRequests();
        $this->loadPendingRequests();
    }


    public function openModifyModal($requestId): void
    {
        $request = PetSittingRequest::where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->findOrFail($requestId);

        $this->requestId = $request->id;

        $this->requested_start_date = $request->start_date;
        $this->requested_end_date = $request->end_date;
        $this->requested_description = '';

        $this->dispatch('open-modify-modal');
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

            <h2 class="text-text uppercase text-3xl font-extrabold mb-8">
                {{ __('request.modifyToProcess') }}
            </h2>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($receivedModificationRequests as $request)

                    <x-cards.cards_modify_request
                        :request="$request"
                    />

                @empty

                    <div class="col-span-full bg-card border-2 border-element rounded-2xl p-8">
                        <p class="text-center text-text text-lg font-semibold">
                            {{ __('request.noModifyToProcess') }}
                        </p>
                    </div>

                @endforelse

            </div>

        </div>

        <div class="mb-20">

            <h2 class="text-text uppercase text-3xl font-extrabold mb-8">
                {{ __('request.modifySent') }}
            </h2>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($sentModificationRequests as $request)

                    <x-cards.card_sent_modify
                        :request="$request"
                    />

                @empty

                    <div class="col-span-full bg-card border-2 border-element rounded-2xl p-8">
                        <p class="text-center text-text text-lg font-semibold">
                            {{ __('request.noModifySent') }}
                        </p>
                    </div>

                @endforelse

            </div>

        </div>

        <div class="mb-20">

            <div class="flex items-center gap-4 mb-8">

                <h2 class="text-text uppercase text-3xl font-extrabold" id="pending">
                    {{ __('request.pendingRequests') }}
                </h2>

            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($requests as $request)

                    <x-cards.animal_card_request_ps
                        :request="$request"
                    />

                @empty

                    <div class="col-span-full bg-card border-2 border-element rounded-2xl p-8">

                        <p class="text-center text-text text-lg font-semibold">
                            {{ __('request.noPendingRequests') }}
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

        <div class="mb-20">

            <div class="flex items-center gap-4 mb-8">

                <h2 class="text-text uppercase text-3xl font-extrabold" id="accepted">
                    {{ __('request.acceptedRequests') }}
                </h2>

            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($acceptedRequests as $request)

                    <x-cards.animal_card_request_ps
                        :request="$request"
                    />

                @empty

                    <div class="col-span-full bg-card border-2 border-element rounded-2xl p-8">

                        <p class="text-center text-text text-lg font-semibold">
                            {{ __('request.noAcceptedRequests') }}
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

        <div>

            <div class="flex items-center gap-4 mb-8">

                <h2 class="text-text uppercase text-3xl font-extrabold" id="refused">
                    {{ __('request.refusedRequests') }}
                </h2>

            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($refusedRequests as $request)

                    <x-cards.animal_card_request_ps
                        :request="$request"
                    />

                @empty

                    <div class="col-span-full bg-card border-2 border-element rounded-2xl p-8">

                        <p class="text-center text-text text-lg font-semibold">
                            {{ __('request.noRefusedRequests') }}
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </section>
    <x-modale.modify_petsitting_request_modal/>

</div>
