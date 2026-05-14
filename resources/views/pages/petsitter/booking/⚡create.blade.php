<?php

use App\Models\AnimalType;
use App\Models\PetSittingRequest;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public string $last_name = '';
    public string $first_name = '';
    public string $email = '';
    public string $description = '';
    public $types = [];
    public $animals = [];
    public $image;

    public function mount()
    {
        $this->types = AnimalType::all();
    }

    public function store()
    {
        $validated = $this->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'animals'=> 'required|array',
        ]);

        $request = PetSittingRequest::create($validated);
        $this->reset();

        $request->animalTypes()->sync($this->animals);
        if ($this->image) {

            $path = $this->image->store('animals', 'public');

            $request->image = $path;

            $request->save();
        }
    }
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20">Envoyez une demande à nom
            du petsitter</h1>
        <span class="block text-text text-sm text-center mb-6">En remplissant ce formulaire, vous envoyez une demande au petsitter choisis, celui-ci répondra à votre demande dans les plus brefs délais.</span>
    </section>
    <form wire:submit.prevent="store" class="w-8/10 mx-auto" enctype="multipart/form-data">
        <div class="flex gap-6 mt-6 justify-between">
            <x-forms.input-label wire:model="last_name" label="Nom de famille *" name="last_name" type="text" placeholder="Dupont" value=""
                                 required class="w-1/2"/>
            <x-forms.input-label wire:model="first_name" label="Prénom *" name="first_name" type="text" placeholder="Julie" value="" required
                                 class="w-1/2"/>
        </div>
        <div class="mt-6">
            <x-forms.input-label wire:model="email" label="Email *" type="email" name="email" placeholder="mail@test.be" value=""
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
                <x-forms.input-label wire:model="image"  name="image" label="Photo de l’animal" type="file"/>
            </div>
            <div class="mt-6">
                <label for="description" class="block text-sm  text-text uppercase font-bold mb-1">Besoins spécifiques de
                    l'animal</label>
                <textarea wire:model="description" name="description" id="" cols="30" rows="10"
                          class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none mb-6"></textarea>
            </div>
            <div class="lg:mb-20">
                <x-forms.button>
                    Envoyer ma demande
                </x-forms.button>
            </div>
        </div>
    </form>
</div>
