<?php

use App\enum\UserRole;
use App\Enums\PetsitterStatus;
use App\Models\AnimalType;
use App\Models\Habitation;
use App\Models\User;
use App\Models\VisitType;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new  #[Title('Devenir petsitter')]
class extends Component {

    use WithFileUploads;

    public string $last_name = '';
    public string $first_name = '';
    public string $phone = '';
    public string $email = '';
    public string $adress = '';
    public string $zip = '';
    public string $habitation_id = '';
    public $animals = [];
    public $types = [];
    public $habitations = [];
    public $visits = [];
    public $visitTypes = [];
    public $image;
    public string $location;
    public string $description;
    public $petsitter;


    public function mount(): void
    {
        $this->types = AnimalType::all();
        $this->habitations = Habitation::all();
        $this->visitTypes = VisitType::all();
        $this->petsitter = User::where('role', UserRole::PETSITTER)
            ->where('petsitter_status', PetsitterStatus::PENDING)->get();
    }


    public function store()
    {
        $validated = $this->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'image' => 'image',
            'phone' => 'required|string',
            'adress' => 'required|string',
            'zip' => 'required|integer|max_digits:5',
            'location' => 'required|string',
            'habitation_id' => 'required|exists:habitations,id',
            'animals' => 'required|array',
            'visits' => 'required|array',
            'description' => 'nullable|string',
        ]);

        $user = User::create([...$validated, 'password' => Hash::make('password'), 'role' => UserRole::PETSITTER, 'petsitter_status'=>PetsitterStatus::PENDING]);
        $user->animalTypes()->sync($this->animals);
        $user->visitTypes()->sync($this->visits);
        if ($this->image) {

            $path = $this->image->store('petsitters', 'public');

            $user->image = $path;

            $user->save();
        }


        session()->flash('success', 'Demande envoyée avec succès');
        $this->reset([
            'last_name',
            'first_name',
            'phone',
            'email',
            'adress',
            'zip',
            'habitation_id',
            'animals',
            'visits',
            'image',
            'location',
            'description',
        ]);
    }
};
?>
<div>
    <section>
        <h1 class="text-text text-2xl font-bold uppercase text-center mt-20">S'inscrire pour devenir petsitter</h1>
        <p class="w-1/2 text-center mx-auto">Les petsitters de PuppyClub sont sélectionnés avec attention afin de
            garantir un service de qualité. Merci de compléter le formulaire ci-dessous pour soumettre votre
            candidature.</p>
        <form wire:submit.prevent="store" class="w-8/10 mx-auto mt-6">
            @csrf
            <div>
                <x-forms.input-label type="file" name="image" label="Photo de profil" wire:model="image"/>
            </div>
            <div class="flex gap-6 justify-between">
                <x-forms.input-label wire:model="last_name" type="text" name="last_name" label="Nom *"/>
                <x-forms.input-label wire:model="first_name" type="text" name="first_name" label="Prénom *"/>
            </div>
            <div class="flex gap-6 justify-between">
                <x-forms.input-label wire:model="email" type="email" name="email" label="Email *"/>
                <x-forms.input-label wire:model="phone" type="text" name="phone" label="Numéro de téléphone *"/>
            </div>
            <div class="flex gap-6 justify-between">
                <x-forms.input-label wire:model="adress" type="text" name="adress" label="Adresse postale *"/>
                <x-forms.input-label wire:model="zip" type="number" name="zip" label="Code Postal *"/>
            </div>
            <div>
                <x-forms.input-label wire:model="location" type="text" name="location" label="Localité"/>
            </div>
            <div class="flex gap-12 justify-between">

                <div class="w-1/3">

                    <label class="block text-sm text-text uppercase font-bold mb-3">
                        Type d'habitation *
                    </label>

                    <div class="flex flex-col gap-3">

                        @foreach($habitations as $habitation)

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="radio"
                                    wire:model="habitation_id"
                                    name="home"
                                    value="{{ $habitation->id }}"
                                    class="w-4 h-4 accent-btn-green"
                                >

                                <span class="text-text">
                        {{ ucfirst($habitation->name ) }}
                    </span>

                            </label>

                        @endforeach

                    </div>

                </div>
                <div class="w-1/3">
                    <label class="block text-sm text-text uppercase font-bold mb-3">
                        Choisissez votre type d’animal
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

                    </div>
                </div>
                <div class="w-1/3">
                    <label class="block text-sm text-text uppercase font-bold mb-3">
                        Choisissez votre type de visites
                    </label>

                    <div class="flex flex-col gap-3">

                        @foreach($visitTypes as $visit)

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="checkbox"
                                    wire:model="visits"
                                    value="{{ $visit->id }}"
                                    class="w-4 h-4 accent-btn-green"
                                >

                                <span class="text-text">
                        {{ ucfirst($visit->name) }}
                    </span>

                            </label>

                        @endforeach

                    </div>
                </div>
            </div>

            <div class="mt-6 mb-6">
                <label class="text-text font-bold uppercase" for="infos">Informations supplémentaires</label>
                <textarea wire:model="description" name="description" id="description" cols="30" rows="10"
                          class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none"></textarea>
            </div>
            <div>
                <x-forms.button>
                    Envoyer votre demande
                </x-forms.button>
            </div>
        </form>
        @if('success')
        <x-message_success/>
        @endif
    </section>
</div>
