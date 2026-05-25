<?php

use App\Enums\PetsitterStatus;
use App\Models\Pet;
use App\Models\PetSittingRequest;
use Livewire\Component;

new class extends Component {
    public $requests = [];
    public $note;

    public function mount(): void
    {
        $this->requests = PetSittingRequest::with([
            'user',
            'pet',
            'pet.breed',
            'pet.animalType',
        ])
            ->where('status', PetsitterStatus::ACCEPTED)
            ->where('end_date', '<', now())
            ->where('petsitter_id', auth()->id())
            ->get();
    }

    public function storeNote($requestId): void
    {
        $validated = $this->validate([
            'note'=> 'string'
        ]);
        $request = PetSittingRequest::findOrFail($requestId);

        $request->note = $validated['note'];
        $request->save();
        $this->reset('note');
        $this->dispatch('close-note-modal');

    }


};
?>

<div>
    <x-header.PetsitterNav/>
    <section>
        <h1 class="text-text lg:text-2xl text-lg uppercase font-bold ml-50"> Mon historique</h1>
    @foreach($requests as $request)
      <x-cards.petsitter_history
          :request="$request"
      />
    @endforeach
        <x-modale.petsitter_notes_modal
            :request="$request"
        />
    </section>
</div>
