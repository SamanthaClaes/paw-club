<?php

use App\Enums\PetsitterActive;
use App\Enums\PetsitterRequestStatus;
use App\Enums\PetsitterStatus;
use App\Mail\PetsitterAcceptedMail;
use App\Mail\PetsitterRefusedRequestMail;
use App\Mail\PetsittingRefusedRequestMail;
use App\Models\PetSittingRequest;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

new #[Layout('layouts::dashboard', ['title' => 'Nos petsitters | Paw-club'])]
class extends Component {

    use WithPagination;

    public $search = '';
    public ?User $selectedPetsitter = null;
    public int $favoritesCount = 0;
    public int $acceptedRequestsCount = 0;
    public int $refusedRequestsCount = 0;


    public function petsitterQuery()
    {
        return User::where('is_petsitter', true)
            ->with([
                'habitation',
                'animalTypes',
            ]);
    }


    #[Computed]
    public function petsitters(): LengthAwarePaginator
    {
        return $this->petsitterQuery()
            ->where('petsitter_status', PetsitterStatus::ACCEPTED)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate(
                perPage: 4,
                pageName: 'petsittersPage'
            );
    }

    #[Computed]
    public function petsitterRequests(): LengthAwarePaginator
    {
        return $this->petsitterQuery()
            ->where('petsitter_status', PetsitterStatus::PENDING)
            ->paginate(
                perPage: 4,
                pageName: 'requestsPage'
            );
    }


    public function acceptPetsitterRequest($requestId): void
    {
        $petsitter = User::findOrFail($requestId);
        $petsitter->petsitter_status = PetsitterStatus::ACCEPTED;
        $petsitter->save();
        $token = Password::createToken($petsitter);
        Mail::to($petsitter->email)->queue(new PetsitterAcceptedMail($petsitter, $token));
        $this->resetPage('requestsPage');
    }

    public function rejectPetsitterRequest($requestId): void
    {
        $petsitter = User::findOrFail($requestId);

        $petsitter->petsitter_status = PetsitterStatus::REFUSED;

        $petsitter->save();
        Mail::to($petsitter->email)->queue(new PetsitterRefusedRequestMail($petsitter));
        $this->resetPage('requestsPage');

    }

    public function deletePetsitter($userId): void
    {
        $petsitter = User::findOrFail($userId);

        $petsitter->delete();

        $this->resetPage();
    }

    #[On('open-petsitter-status-modal')]
    public function loadPetsitter($userId): void
    {
        $this->selectedPetsitter = User::findOrFail($userId);
    }

    public function confirmStatusChange($userId): void
    {
        $petsitter = User::findOrFail($userId);

        $this->dispatch(
            'open-petsitter-status-modal',
            userId: $petsitter->id
        );
    }

    public function changePetsitterStatus($userId): void
    {
        $petsitter = User::findOrFail($userId);

        $petsitter->petsitter_active =
            $petsitter->petsitter_active === PetsitterActive::ACTIVE
                ? PetsitterActive::INACTIVE
                : PetsitterActive::ACTIVE;

        $petsitter->save();

        $this->resetPage();
    }

    public function showPetsitterStats($userId): void
    {
        $this->selectedPetsitter = User::findOrFail($userId);

        $this->favoritesCount = DB::table('favorite_petsitters')
            ->where('petsitter_id', $userId)
            ->count();

        $this->acceptedRequestsCount = PetSittingRequest::where('petsitter_id', $userId)
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->count();

        $this->refusedRequestsCount = PetSittingRequest::where('petsitter_id', $userId)
            ->where('status', PetsitterRequestStatus::REFUSED)
            ->count();

        $this->dispatch('open-petsitter-stats-modal');
    }

};
?>

<div>
    <div class="ml-25">
        <div>
            <x-dashboard.petsitter-table
                title="Liste de nos petsitters"
                :petsitters="$this->petsitters"
            />
        </div>
        <div>
            <x-dashboard.petsitterRequest-table
                title="Liste des demandes des petsitters"
                :petsitters="$this->petsitterRequests"
                :show-actions=" true "
            />
        </div>

        <div>
            <x-modale.petsitter_active_modale
                :selected-petsitter="$selectedPetsitter"
            />
        </div>

        <div>
            <x-modale.petsitter-stats
                :selected-petsitter="$selectedPetsitter"
                :favorites-count="$favoritesCount"
                :accepted-requests-count="$acceptedRequestsCount"
                :refused-requests-count="$refusedRequestsCount"
            />
        </div>
    </div>
</div>
