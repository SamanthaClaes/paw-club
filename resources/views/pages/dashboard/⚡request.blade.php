<?php

use App\Enums\ActivityType;
use App\Enums\DayCareRequestStatus;
use App\Mail\PetsitterAcceptedMail;
use App\Models\Activity;
use App\Models\DayCareRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::dashboard', ['title' => 'Demandes de garde | Paw-club'])]
class extends Component {
    use WithPagination;

    public ?User $selectedOwner = null;

    public function mount(): void
    {
        $this->loadPendingRequests();
    }

    #[Computed]
    public function loadPendingRequests(): LengthAwarePaginator
    {
        return DayCareRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed',
        ])
            ->where('status', DayCareRequestStatus::PENDING)
            ->latest()
            ->paginate(2);
    }

    public function acceptRequest($requestId): void
    {
        $request = DayCareRequest::findOrFail($requestId);

        $request->status = DayCareRequestStatus::ACCEPTED;

        $request->save();

        Activity::create([
            'action' => ActivityType::DAYCARE_REQUEST_ACCEPTED,
            'user_id' => auth()->id(),
            'pet_id' => $request->pet_id,
            'day_care_request_id' => $request->id,
        ]);

        $this->loadPendingRequests();

    }

    public function rejectRequest($requestId): void
    {
        $request = DayCareRequest::findOrFail($requestId);

        $request->status = DayCareRequestStatus::REFUSED;

        Activity::create([
            'action' => ActivityType::DAYCARE_REQUEST_REFUSED,
            'user_id' => auth()->id(),
            'pet_id' => $request->pet_id,
            'day_care_request_id' => $request->id,
        ]);

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
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($this->loadPendingRequests as $request)
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
    </div>
    <x-modale.user_infos_modale
        :selected-owner="$selectedOwner"
    />
    <div class="mt-12 flex justify-center">
        {{ $this->loadPendingRequests->links(data: ['scrollTo' => false]) }}
    </div>
</div>
