<?php

use Livewire\Component;

new class extends Component {
    public function store()
    {

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
                <x-forms.input-label type="text" name="last_name" label="Nom"/>
                <x-forms.input-label type="text" name="first_name" label="Prenom"/>
            </div>
            <div>
                <x-forms.input-label type="email" name="email" label="Email"/>
            </div>
            <div class="flex gap-6 justify-between">
                <x-forms.input-label type="text" name="adress" label="Adresse postale"/>
                <x-forms.input-label type="number" name="zip" label="Code Postal"/>
            </div>
            <div class="flex gap-6">
                <x-forms.select-option label="Type d'habitation" name="home">
                    <option value="">Choisir votre lieu d'habitation</option>
                    <option value="home">Maison</option>
                    <option value="flat">Appartement</option>
                    <option value="duplex">Studio</option>
                    <option value="farm">Ferme</option>
                </x-forms.select-option>
                <x-forms.select-option label="Type d'animaux" name="animals">
                    <option value="">Choisir votre type d'animaux à garder</option>
                    <option value="dog">Chien</option>
                    <option value="cat">Chat</option>
                    <option value="rabbit">Lapin</option>
                    <option value="ferret">Furet</option>
                    <option value="hamster">Hamster</option>
                    <option value="snake">Serpent</option>
                </x-forms.select-option>

            </div>
            <div class="mt-6 mb-6">
                <label  class="text-text font-bold uppercase" for="infos">Informations supplémentaires</label>
                <textarea name="infos" id="infos" cols="30" rows="10"  class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none"></textarea>
            </div>
            <div>
                <x-forms.button>
                    Envoyer votre demande
                </x-forms.button>
            </div>
        </form>
    </section>
</div>
