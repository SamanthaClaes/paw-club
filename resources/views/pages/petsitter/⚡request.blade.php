<?php

use App\Enums\DayCareRequestStatus;
use App\Models\DayCareRequest;
use App\Models\PetSittingRequest;
use Livewire\Component;

new class extends Component {
    public $requests;

    public function mount(): void
    {
        $this->requests = PetSittingRequest::with('animalType')->get();
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
