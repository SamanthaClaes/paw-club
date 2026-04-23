<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <section class="relative w-full h-[40vh] overflow-hidden">
        <img src="{{ asset('img/Hero_home.jpeg') }}" alt="pleins de chiens en balade"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center gap-4">
            <h1 class="
               text-white text-6xl font-bold uppercase z-10">Paw club</h1>
            <span class=" text-white text-3xl z-10">Un service de garde fiable et attentionné pour accompagner votre animal en toute sérénité.</span>
        </div>
    </section>
    <section class="px-6 py-12">
        <div class="mx-auto mr-25 ml-25 px-6 border-5 border-element rounded-lg p-8">
        <div class="flex justify-center">
                <h2 class="text-text text-3xl uppercase font-sans">A propos de nous</h2>
            </div>
            <div class="p-8">
                <p class="text-lg/8 text-text">PawClub est un espace de garderie dédié exclusivement aux chiens, offrant
                    un environnement sécurisé, encadré et adapté à leurs besoins.
                    Chaque animal y est accueilli avec attention, dans un cadre pensé pour favoriser son bien-être, sa
                    socialisation et son épanouissement tout au long de la journée.
                    En parallèle, la plateforme propose un service de mise en relation permettant de réserver une garde
                    auprès de l’un de nos petsitters. Chaque petsitter définit ses disponibilités et les types d’animaux
                    qu’il accepte, afin de garantir une prise en charge adaptée et personnalisée.
                    PawClub permet également à toute personne souhaitant s’investir dans la garde d’animaux de devenir
                    petsitter, en rejoignant une communauté encadrée et orientée vers le bien-être animal.</p>
            </div>
            <div class="flex justify-center bg-card-green hover:bg-hover p-5 w-1/2 mx-auto rounded-lg mb-6">
                <a href="#" class="text-white text-2xl font-bold uppercase">Découvrir nos petsitters</a>
            </div>
        </div>
    </section>
</div>
