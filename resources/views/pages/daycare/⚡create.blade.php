<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl">Envoyez une demande de garde pour notre garderie</h1>
        <span class="block text-text text-sm text-center mb-5 lg:m-10">En remplissant ce formulaire, vous envoyez une demande de garde à notre garderie, une réponse vous sera envoyée dans les plus brefs délais.
N’oubliez pas que notre garderie ne s’occupe que des chiens</span>
    </section>
    <form action="" method="get">
            <x-forms.select-option/>
        <textarea name="need" id="need" cols="30" rows="10">Besoins spécifiques de l’animal</textarea>
    </form>
</div>
