<?php

use App\enum\UserRole;
use App\Models\AnimalType;
use App\Models\PetSittingRequest;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public string $animal_name = '';
    public string $animal_age = '';
    public string $breed = '';
    public string $start_date = '';
    public string $end_date = '';
    public string $last_name = '';
    public string $first_name = '';
    public string $email = '';
    public string $description = '';
    public $types = [];
    public string $animal_type_id = '';
    public $image;
    public User $petsitter;
    public $gender;
    public $pets = [];
    public $user;

    public function mount(User $user): void
    {
        abort_if($user->role !== UserRole::PETSITTER, 404);

        $this->petsitter = $user;
        $this->user = Auth::user();

        $this->types = AnimalType::all();
        $this->pets = $this->user
            ->pets()
            ->with('breed')
            ->get();
    }

    public function store(): void
    {
        $validated = $this->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email',
            'image' => 'nullable|image',
            'animal_age' => 'required|integer',
            'animal_name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'breed' => 'required|string',
            'gender'=>'required|boolean',
            'description' => 'nullable|string',
            'animal_type_id' => 'required|exists:animal_types,id',
        ]);

        $request = PetSittingRequest::create($validated);

        if ($this->image) {

            $path = $this->image->store('animals', 'public');

            $request->image = $path;

            $request->save();
        }
        $this->reset();
    }
};
?>

<div>
    <section>
        {{$petsitter->id}}
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20">Envoyez une demande
            à {{ $petsitter->first_name }}</h1>
        <span class="block text-text text-sm text-center mb-6">En remplissant ce formulaire, vous envoyez une demande au petsitter choisis, celui-ci répondra à votre demande dans les plus brefs délais.</span>
    </section>
    <form wire:submit.prevent="store" class="w-8/10 mx-auto" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col gap-3">
            <x-forms.select-option wire:model.live="pet_id" label="Nom et race de l'animal" name="pet_id">
                <option value="">Choisir mon animal</option>
                @foreach( $pets as $pet)
                    <option value="{{ $pet->id }}">
                        {{ $pet->name }} - {{$pet->breed->name}}
                    </option>
                @endforeach
            </x-forms.select-option>
            <div class="mt-6">
                <x-forms.input-label wire:model="image" name="image" label="Photo de l’animal" type="file"/>
            </div>
            <div class="flex gap-6">
                <x-forms.input-label type="date" wire:model="start_date" name="start_date"
                                     label="Date de début de garde"/>
                <x-forms.input-label type="date" wire:model="end_date" name="end_date" label="Date de fin de garde"/>
            </div>
            <div class="mt-6">
                <label for="description" class="block text-sm  text-text uppercase font-bold mb-1">Besoins spécifiques
                    de
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
