<?php

use App\Models\PetSittingRequest;
use Livewire\Component;

new class extends Component {
    public $requests;

    public function mount()
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
            :animal_name="$request->animal_name"
            :type="$request->animalType?->type"
            :name="$request->first_name . ' ' . $request->last_name"
            :start_date="$request->start_date"
            :end_date="$request->end_date"
            :description="$request->description"
            :email="$request->email"
            :animal_age="$request->animal_age"
            :breed="$request->breed"
            :image="$request->image"
        />

    @endforeach
</div>
