<?php

use App\Models\DayCareRequest;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Demandes de garde'])]
class extends Component {
    public $requests = [];

    public function mount(): void
    {
       $this->requests = DayCareRequest::with([
           'user',
           'pet',
           'pet.animalType',
           'pet.breed',
       ])->get();
    }
};
?>

<div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h1 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des demandes de
            garde</h1>
    </section>
    <div class="ml-25 border-2 border-stroke px-20 py-10 rounded-lg mr-25 max-w-4xl">
        <div class="flex gap-6">
            <section>
                <h2 class="text-text uppercase font-bold">Titre</h2>
            </section>
            <div>
                @foreach($requests as $request)
                    {{ $request->pet->name }}
                @endforeach
            </div>
        </div>
    </div>
</div>
