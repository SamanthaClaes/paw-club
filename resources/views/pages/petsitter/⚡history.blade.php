<?php

use App\Enums\PetsitterStatus;
use App\Models\PetSittingRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mon historique')]
class extends Component {
    public $requests = [];
    public $note;

    public function mount(): void
    {
        $this->loadHistoryRequests();
    }

    public function loadHistoryRequests(): void
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
            'note' => 'nullable|string'
        ]);
        $request = PetSittingRequest::where('petsitter_id', Auth::id())
            ->findOrFail($requestId);

        $request->note = $validated['note'];
        $request->save();
        $this->loadHistoryRequests();
        $this->reset('note');
        $this->dispatch('close-note-modal');

    }


};
?>

<div class="max-w-7xl mx-auto px-6">
    <x-header.PetsitterNav/>
    <section class="mt-20">
        <h1 class="text-text lg:text-2xl text-lg uppercase font-bold mb-10"> Mon historique</h1>
        <div class="space-y-10">
            @foreach($requests as $request)
                <x-cards.petsitter_history
                    :request="$request"
                />
            @endforeach
        </div>
        @foreach($requests as $request)
            <x-modale.petsitter_notes_modal
                :request="$request"
            />
        @endforeach
    </section>
</div>
