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
            ->where('user_id', auth()->id())
            ->get();
    }

};
?>

<div>
    <section>
        <x-header.OwnerNav/>
        <section class="mt-20">
            <h1 class="text-text lg:text-2xl text-lg uppercase font-bold mb-10"> Mon historique</h1>
            <div class="space-y-10">
                @foreach($requests as $request)
                    <x-cards.card_owner_history/>
                @endforeach
            </div>
        </section>
    </section>
</div>
