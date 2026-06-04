<?php

use App\Enums\DayCareRequestStatus;
use App\Mail\PetsitterAcceptedMail;
use App\Models\DayCareRequest;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Demandes de garde | Paw-club'])]
class extends Component {
    public $requests = [];
    public ?User $selectedOwner = null;

    public function mount(): void
    {
        $this->loadPendingRequests();
    }

    public function loadPendingRequests(): void
    {
        $this->requests = DayCareRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed',
        ])
            ->where('status', DayCareRequestStatus::PENDING)
            ->get();
    }

    public function acceptRequest($requestId): void
    {
        $request = DayCareRequest::findOrFail($requestId);

        $request->status = DayCareRequestStatus::ACCEPTED;

        $request->save();

        $this->loadPendingRequests();

    }

    public function rejectRequest($requestId): void
    {
        $request = DayCareRequest::findOrFail($requestId);

        $request->status = DayCareRequestStatus::REFUSED;

        $request->save();

        $this->loadPendingRequests();
    }


    #[On('open-owner-modal')]
    public function loadOwner($userId): void
    {
        $this->selectedOwner = User::with([
            'pets',
            'pets.breed',
            'pets.animalType',
        ])->findOrFail($userId);
    }


};
?>

<div>
    <section class=" mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h1 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des demandes de
            garde</h1>
    </section>
    @forelse($requests as $request)
        <x-dashboard.cards_daycare_request_admin
            :request="$request"
        />

    @empty
        <div class="bg-card border-2 border-element rounded-2xl p-8">

            <p class="text-center text-text text-lg font-semibold">
                Aucune demande en attente
            </p>
        </div>
    @endforelse
    <x-modale.owner_infos_modale
        :selected-owner="$selectedOwner"
    />
</div>
