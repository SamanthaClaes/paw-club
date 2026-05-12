<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <x-header.PetsitterNav/>
    <section>
        <h1 class="text-text uppercase text-2xl mb-6 ml-25 font-bold">
            Mes demandes en attentes
        </h1>
    </section>

    <x-cards.animal_card_request_ps/>
</div>
