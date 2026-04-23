<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <section class="relative w-full h-[60vh] overflow-hidden">
        <img src="{{ asset('img/Hero_home.jpeg') }}" alt="pleins de chiens en balade"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center gap-4">
            <h1 class="
               text-white text-6xl font-bold uppercase z-10">Paw club</h1>
            <span class=" text-white text-3xl z-10">Un service de garde fiable et attentionné pour accompagner votre animal en toute sérénité.</span>
        </div>
    </section>
</div>
