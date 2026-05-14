<?php

use App\Models\AnimalType;
use Livewire\Component;

new class extends Component {
    public $types = [];
    public $animals = [];

    public function mount()
    {
        $this->types = AnimalType::all();
    }

    public function store()
    {
       $validated = $this->validate([
           'last_name'=>'required|string',
           'first_name'=>'required|string',
           'email'=>'required|email',
           'image'=>'image',
           'description'=>'string',
       ]);

        $user->animalTypes()->sync($this->animals);
    }
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20">Envoyez une demande à nom
            du petsitter</h1>
        <span class="block text-text text-sm text-center mb-6">En remplissant ce formulaire, vous envoyez une demande au petsitter choisis, celui-ci répondra à votre demande dans les plus brefs délais.</span>
    </section>
    <form action="#" class="w-8/10 mx-auto" enctype="multipart/form-data">
        <div class="flex gap-6 mt-6 justify-between">
            <x-forms.input-label label="Nom de famille *" name="last_name" type="text" placeholder="Dupont" value=""
                                 required class="w-1/2"/>
            <x-forms.input-label label="Prénom *" name="first_name" type="text" placeholder="Julie" value="" required
                                 class="w-1/2"/>
        </div>
        <div class="mt-6">
            <x-forms.input-label label="Email *" type="email" name="email" placeholder="mail@test.be" value=""
                                 required class="w-full"/>
        </div>
            <label class="block text-sm text-text uppercase font-bold mb-3">
                Choisissez votre animal
            </label>

            <div class="flex flex-col gap-3">

                @foreach($types as $type)

                    <label class="flex items-center gap-3 cursor-pointer">

                        <input
                            type="checkbox"
                            wire:model="animals"
                            value="{{ $type->id }}"
                            class="w-4 h-4 accent-btn-green"
                        >

                        <span class="text-text">
                        {{ ucfirst($type->type) }}
                    </span>

                    </label>
                @endforeach
        <div class="mt-6">
            <label for="picture" class="block text-sm  text-text uppercase font-bold mb-1">Photo de l’animal</label>
            <input type="file"
                   class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background">
        </div>
        <div class="mt-6">
            <label for="msg" class="block text-sm  text-text uppercase font-bold mb-1">Besoins spécifiques de
                l'animal</label>
            <textarea name="msg" id="" cols="30" rows="10"
                      class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none mb-6"></textarea>
        </div>
        <div class="lg:mb-20">
            <x-forms.button>
                Envoyer ma demande
            </x-forms.button>
        </div>
    </form>
</div>
