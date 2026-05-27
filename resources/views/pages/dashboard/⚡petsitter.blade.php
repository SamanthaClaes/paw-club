<?php

use App\Enums\PetsitterStatus;
use App\Mail\PetsitterAcceptedMail;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Nos petsitters'])]
class extends Component {

    public $petsitters;
    public $petsitterRequests;

    public function mount(): void
    {
        $this->petsitters = $this->petsitterQuery()
            ->where('petsitter_status', PetsitterStatus::ACCEPTED)
            ->get();

        $this->loadingPendingRequest();
    }

    public function petsitterQuery()
    {
        return User::where('is_petsitter', true)
            ->with([
                'habitation',
                'animalTypes',
            ]);
    }

    public function loadingPendingRequest(): void
    {
        $this->petsitterRequests = $this->petsitterQuery()
            ->where('petsitter_status', PetsitterStatus::PENDING)
            ->get();
    }

    public function acceptPetsitterRequest($requestId): void
    {
        $petsitter = User::findOrFail($requestId);
        $petsitter->petsitter_status = PetsitterStatus::ACCEPTED;
        $petsitter->save();
        Mail::to($petsitter->email)->queue(new PetsitterAcceptedMail($petsitter));
        $this->loadingPendingRequest();
    }

    public function rejectPetsitterRequest($requestId): void
    {
        $petsitter = User::findOrFail($requestId);

        $petsitter->petsitter_status = PetsitterStatus::REFUSED;

        $petsitter->save();

        $this->loadingPendingRequest();

    }

};
?>

<div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste de nos petsitters</h2>
    </section>
    <div class="ml-25">
        <div>
            <x-dashboard.petsitter-table
                title="Liste de nos petsitters"
                :petsitters="$petsitters"
            />
        </div>
        <div>
            <x-dashboard.petsitter-table
                title="Liste des demandes des petsitters"
                :petsitters="$petsitterRequests"
                :show-actions=" true "
            />
        </div>
    </div>
</div>
