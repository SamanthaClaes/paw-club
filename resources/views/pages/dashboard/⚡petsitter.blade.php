<?php

use App\Enums\PetsitterStatus;
use App\Mail\PetsitterAcceptedMail;
use App\Mail\PetsittingRefusedRequestMail;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::dashboard', ['title' => 'Nos petsitters | Paw-club'])]
class extends Component {

    use WithPagination;

    public $search = '';



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
        Mail::to($petsitter->email)->queue(new PetsittingRefusedRequestMail($petsitter, $owner, $pet, $request));
        $this->resetPage('requestsPage');

    }

    public function deletePetsitter($userId)
    {
        $petsitter = User::findOrFail($userId);

        $petsitter->delete();

        $this->resetPage();
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
    </div>
</div>
