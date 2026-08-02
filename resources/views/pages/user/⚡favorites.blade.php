<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mes favoris | Paw-club')]
class extends Component {

    #[Computed]
    public function favoritePetsitters()
    {
        return auth()->user()
            ->favoritePetsitters()
            ->with([
                'animalTypes',
                'habitation',
            ])
            ->get();
    }


};
?>


<div class="max-w-7xl mx-auto px-6">

    <x-header.UserNav/>

    <section class="mt-20">

        <h1 class="text-text text-3xl font-bold uppercase mb-10">
            Mes favoris
        </h1>

        <div class="grid grid-cols-1 gap-8 mb-20">

            @forelse($this->favoritePetsitters as $petsitter)

                <x-cards.petsitter_card
                    :name="$petsitter->first_name"
                    :last="$petsitter->last_name"
                    :location="$petsitter->location"
                    :price="$petsitter->price"
                    :image="$petsitter->image"
                    :description="$petsitter->description"
                    :tags="[...$petsitter->animalTypes->map(fn ($animalType) => __('animalTypes.' . $animalType->type))->toArray(), __('habitationType.' . $petsitter->habitation?->name)]"
                    :choose-url=" route('petsitter.booking.create', ['user' => $petsitter->id])"
                    :contact-url=" route('petsitter.contact', ['user' => $petsitter->id])"
                    :petsitter="$petsitter"
                    :is-favorite="true"
                />

            @empty

                <div class="bg-card border-2 border-element rounded-2xl p-8">
                    Vous n'avez encore ajouté aucun petsitter à vos favoris.
                </div>

            @endforelse

        </div>

    </section>

</div>
