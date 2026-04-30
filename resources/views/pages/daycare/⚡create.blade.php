<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Demande à la garderie')] class extends Component {
    //
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl">Envoyez une demande de garde pour
            notre garderie</h1>
        <span class="block text-text text-sm text-center mb-5 lg:m-10">En remplissant ce formulaire, vous envoyez une demande de garde à notre garderie, une réponse vous sera envoyée dans les plus brefs délais.
N’oubliez pas que notre garderie ne s’occupe que des chiens</span>
    </section>
    <div class="flex justify-center gap-6 mt-6">
        <form action="" method="GET" class="w-8/10">
            <div class="lg:flex gap-6 mb-6 justify-between">
                <x-forms.select-option label="Nom de l’animal" name="name">
                    <option value="charles">Charles</option>
                    <option value="mowgli">Mowgli</option>
                    <option value="simba">Simba</option>
                </x-forms.select-option>
                <x-forms.select-option label="Race de l’animal" name="breed">
                    <option value="chihuahua">chihuahua</option>
                    <option value="chihuahua">chihuahua</option>
                    <option value="chihuahua">chihuahua</option>
                </x-forms.select-option>
            </div>
            <label for="need_msg" class="block text-sm  text-text uppercase font-bold">Besoins spécifiques de
                l’animal</label>
            <textarea name="need_msg" id="need_msg" cols="30" rows="10"
                      class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none mb-6">
        </textarea>
            <div class="mb-6">
                <x-forms.button>
                    Envoyer ma demande de garde
                </x-forms.button>
            </div>
        </form>
    </div>
</div>
