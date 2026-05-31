<?php

use App\Enums\PetsitterRequestStatus;
use App\Enums\PetsitterStatus;
use App\Models\PetSittingRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mon historique')]
class extends Component {
    public $requests = [];
    public $note;
    public $ongoingRequests = [];


    public function mount(): void
    {
        $this->loadHistoryRequests();
        $this->loadOngoingRequests();
    }

    public function loadHistoryRequests(): void
    {
        $this->requests = PetSittingRequest::with([
            'user',
            'pet',
            'pet.breed',
            'pet.animalType',
        ])
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->where('end_date', '<', now())
            ->where('petsitter_id', auth()->id())
            ->get();
    }



    public function loadOngoingRequests(): void
    {
        $this->ongoingRequests = PetSittingRequest::with([
            'user',
            'pet',
            'pet.breed',
            'pet.animalType',
        ])
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->where('end_date', '>=', now())
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
    <section>
        <h1 class="text-text lg:text-2xl text-lg uppercase font-bold mb-10 text-center mt-20"> Mon historique</h1>
    </section>
    <x-header.PetsitterNav/>
    <section class="mt-20">
        <div>
            <div>
                <h2 class="text-text lg:text-2xl text-lg uppercase font-bold mb-6 mt-6"> Mes demandes en cours</h2>

                <div class="space-y-10">

                    @forelse($ongoingRequests as $request)
                        <x-cards.petsitter_history
                            :request="$request"
                        />
                        @empty

                            <div class="bg-card border-2 border-element rounded-2xl p-8">
                                Aucune garde terminée pour le moment.
                            </div>
                    @endforelse

                </div>

            </div>
            <h2 class="text-text lg:text-2xl text-lg uppercase font-bold mb-6 mt-6">
                Mes demandes passées
            </h2>
            <div class="space-y-10">
                @forelse($requests as $request)
                    <x-cards.petsitter_history
                        :request="$request"
                    />
                    @empty

                        <div class="bg-card border-2 border-element rounded-2xl p-8">
                            Aucune garde terminée pour le moment.
                        </div>
                @endforelse
            </div>
        </div>
        @foreach($requests as $request)
            <x-modale.petsitter_notes_modal
                :request="$request"
            />
        @endforeach
    </section>
</div>
