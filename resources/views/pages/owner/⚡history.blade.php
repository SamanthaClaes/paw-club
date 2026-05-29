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
            'petsitter',
            'pet',
            'pet.breed',
            'pet.animalType',
        ])
            ->where('user_id', auth()->id())
            ->get();
    }

};
?>

<div>
    <div class="max-w-7xl mx-auto px-6">

        <x-header.OwnerNav/>

        <section class="mt-20">

            <h1 class="text-text lg:text-2xl text-lg uppercase font-bold mb-10">
                Mon historique
            </h1>

            <div class="space-y-10">

                @forelse($requests as $request)

                    <x-cards.card_owner_history
                        :request="$request"
                    />

                @empty

                    <div class="bg-card border-2 border-element rounded-2xl p-8">
                        Aucune garde terminée pour le moment.
                    </div>

                @endforelse

            </div>

        </section>

    </div>
</div>
