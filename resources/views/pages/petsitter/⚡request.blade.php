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
    }

    public function acceptRequest($requestId): void
    {
        $request = PetSittingRequest::findOrFail($requestId);

        $request->status = PetsitterRequestStatus::ACCEPTED;

        $request->save();

        $this->loadPendingRequests();

        $request->refresh();
    }
};
?>

<div>
    <x-header.PetsitterNav/>
    <section>
        <h1 class="text-text uppercase text-2xl mb-6 ml-25 font-bold">
            Mes demandes en attentes
        </h1>
    </section>

    @foreach($requests as $request)

        <x-cards.animal_card_request_ps
            :request="$request"
        />

    @endforeach
</div>
