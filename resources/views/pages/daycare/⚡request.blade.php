<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {
    public User $user;
    public $first_name;
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20">Envoyez une demande à notre
            garderie</h1>
        <p class="block text-text text-sm text-center mb-6">En remplissant ce formulaire, vous envoyez une demande de
            garde à notre garderie, une réponse vous sera envoyée dans les plus brefs délais.
            <span class="font-bold text-text">N’oubliez pas que notre garderie ne s’occupe que des chiens</span></p>
    </section>
    <form action="" class="w-8/10 mx-auto" enctype="multipart/form-data">
        <div class="flex gap-6">
            <x-forms.input-label
                name="last_name"
                type="text"
                wire:model="last_name"
                label="Nom de famille *"
                value="{{ Auth::user()->last_name  }}"
            />
            <x-forms.input-label
                name="first_name"
                type="text"
                wire:model="first_name"
                label="Prénom *"
                value="{{ Auth::user()->first_name }}"
            />
        </div>
        <div class="flex gap-6">
           <x-forms.select-option wire:model="animalName" label="Nom de l’animal" name="animalName">
               <option value="">Nom de l’animal</option>
           </x-forms.select-option>
            <x-forms.select-option wire:model="breed" label="Race de l’animal" name="breed">
               <option value="">Race de l'animal</option>
           </x-forms.select-option>
        </div>
        <div>
            <x-forms.input-label
                name="image"
                type="file"
                label="Photo de l’animal"
            />
        </div>
        <div>
            <label for="infos" class="text-text font-bold uppercase">Informations supplémentaires</label>
            <textarea wire:model="infos" name="infos" id="" cols="30" rows="10"
                      class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none"></textarea>
        </div>
        <div>
            <x-forms.button>
                Envoyez ma demande
            </x-forms.button>
        </div>
    </form>
</div>
