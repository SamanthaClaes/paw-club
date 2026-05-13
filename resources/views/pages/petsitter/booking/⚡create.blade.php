<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20">Envoyez une demande à nom du petsitter</h1>
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
        <div class="flex gap-6 mt-6 justify-between">
            <x-forms.select-option label="Type d'animaux" name="animal">
                <option value="chien">Chien</option>
                <option value="chien">Chien</option>
                <option value="chien">Chien</option>
            </x-forms.select-option>
            <x-forms.select-option label="Type d'habitation" name="home">
                <option value="flat">Appartement</option>
                <option value="home">Maison</option>
                <option value="duplex">Studio</option>
            </x-forms.select-option>
        </div>
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
