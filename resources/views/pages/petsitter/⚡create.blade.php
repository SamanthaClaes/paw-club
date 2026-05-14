<?php

use App\enum\UserRole;
use App\Models\AnimalType;
use App\Models\Habitation;
use App\Models\User;
use App\Models\VisitType;
use Illuminate\Http\RedirectResponse;
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
    public $animals = [];
    public $types = [];
    public $habitations = [];
    public $visits = [];


    public function mount(): void
    {
        $this->types = AnimalType::all();
        $this->habitations = Habitation::all();
        $this->visits = VisitType::all();
    }


    public function store()
    {
        $validated = $this->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'adress' => 'required|string',
            'zip' => 'required|integer|max:4',
            'location' => 'required|string',
            'home' => 'required|string',
            'animals' => 'required|string',
            'visits'=> 'required|string',
        ]);

        $user = User::create([...$validated, 'password' => Hash::make('password'), 'role' => UserRole::PETSITTER]);
        $user->animalTypes()->sync($this->animals);
        $user->visitTypes()->sync($this->visits);

        return redirect()->route('petsitter.create')->with('success', 'Demande envoyée avec succès');
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
            <div>
                <x-forms.input-label wire:model="location" type="text" name="location" label="Localité"/>
                <x-forms.select-option wire:model="visits" label="Choisissez votre type de visite">
                    <option value="">Choisissez votre type de visite</option>
                    @foreach( $visits as $visit)
                        {{ $visit->name }}
                    @endforeach
                </x-forms.select-option>
            </div>
            <div class="flex gap-12 justify-between">

                <div class="w-1/2">

                    <label class="block text-sm text-text uppercase font-bold mb-3">
                        Type d'habitation *
                    </label>

                    <div class="flex flex-col gap-3">

                        @foreach($habitations as $habitation)

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="radio"
                                    wire:model="home"
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

                <div class="w-1/2">

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
        {{--      @if(session('success'))--}}
        <div v
             x-data="{ show: false }"
             x-init="
        setTimeout(() => show = true, 100);
        setTimeout(() => show = false, 4000);
    "
             x-show="show"
             x-cloak
             x-transition:enter="transform transition duration-700 ease-out"
             x-transition:enter-start="opacity-0 -translate-y-10 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transform transition duration-500 ease-in"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-10 scale-95"
             class="bg-green-100 border border-green-400 text-green-800 text-center font-bold px-4 py-3 rounded-lg mb-6 w-1/2 mx-auto">
            <p>
                {{--                   {{ session('success') }}--}}
                Texte de succès !!
            </p>
        </div>
        {{--     @endif--}}
    </section>
</div>
