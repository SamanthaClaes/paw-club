<?php

use App\enum\UserRole;
use App\Models\AnimalType;
use App\Models\Habitations;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Livewire\Component;

new  #[Title('Devenir petsitter')]
class extends Component {
    public string $last_name = '';
    public string $first_name = '';
    public string $phone = '';
    public string $email = '';
    public string $adress = '';
    public string $zip = '';
    public string $home = '';
    public string $animals = '';
    public $types = [];
    public $habitations = [];


    public function mount()
    {
        $this->types = AnimalType::all();
        $this->habitations = Habitations::all();
    }


    public function store(): void
    {
        $validated = $this->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'adress' => 'required|string',
            'zip' => 'required|integer',
            'home' => 'required|string',
            'animals' => 'required|string',
        ]);

        User::create([...$validated, 'password' => Hash::make('password'), 'role' => UserRole::PETSITTER]);
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
            <div class="flex gap-6">
                <x-forms.select-option wire:model="home" label="Type d'habitation *" name="home">
                    <option value="">Choisir votre lieu d'habitation</option>
                    @foreach($habitations as $habitation)
                        <option value="{{ $habitation->id }}">{{ $habitation->name }}</option>
                    @endforeach
                </x-forms.select-option>
                <x-forms.select-option wire:model="animals" label="Type d'animaux *" name="animals">
                    <option value="">Choisir votre type d'animaux à garder</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </x-forms.select-option>

            </div>
            <div class="mt-6 mb-6">
                <label class="text-text font-bold uppercase" for="infos">Informations supplémentaires</label>
                <textarea wire:model="infos" name="infos" id="infos" cols="30" rows="10"
                          class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none"></textarea>
            </div>
            <div>
                <x-forms.button>
                    Envoyer votre demande
                </x-forms.button>
            </div>
        </form>
    </section>
</div>
