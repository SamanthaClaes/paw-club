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
        <h1 class="text-text text-3xl font-extrabold uppercase text-center mt-20 mb-10"> {{ __('history.title') }}</h1>
    </section>
    <x-header.PetsitterNav/>
    <section class="mt-20">
        <div>
            <div>
                <h2 class="text-text uppercase text-3xl font-extrabold mb-8"> {{ __('history.ongoing') }}</h2>

                <div class="space-y-10">

                    @forelse($ongoingRequests as $request)
                        <x-cards.petsitter_history
                            :request="$request"
                        />
                        @empty

                            <div class="bg-card border-2 border-element rounded-2xl p-8">
                                <p class="text-center text-text text-lg font-semibold">
                                        {{ __('history.noRequestOngoing') }}
                                </p>
                            </div>
                    @endforelse

                </div>

            </div>
            <h2 class="text-text uppercase text-3xl font-extrabold mb-8 mt-6">
               {{ __('history.requested') }}
            </h2>
            <div class="space-y-10">
                @forelse($requests as $request)
                    <x-cards.petsitter_history
                        :request="$request"
                    />
                    @empty

                        <div class="bg-card border-2 border-element rounded-2xl p-8 mb-6">
                            <p class="text-center text-text text-lg font-semibold">
                            {{ __('history.noRequestEnd') }}
                            </p>
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
