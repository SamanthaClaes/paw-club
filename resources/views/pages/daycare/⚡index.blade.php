<?php

use Livewire\Component;

new class extends Component {
    public string $title = 'Paw Club';

};
?>

<div>
    <section class=" m-5 mx-5  lg:mt-20">
        <div class="flex flex-row-reverse gap-8 relative" >
            <img src="{{ asset('img/hero_image.jpeg') }}" alt="personne assise qui jouent avec des chiens de petites tailles"
                     class=" hidden lg:w-1/2  lg:object-cover lg:rounded-lg lg:block">
            <div class="border-5 border-element rounded-lg py-10">
                <h1 class=" text-text text-2xl text-center font-bold mb-4">{{ $title }}</h1>
                <span class="block text-text text-sm text-center mb-10 lg:m-5">
                    La garderie qui fait sentir vos compagnons comme à la maison, même en votre absence
                </span>
                <span class="block text-center text-sm text-text mb-5 lg:mb-10">
                    PawClub est une garderie canine pensée pour offrir à votre compagnon un environnement sécurisé, encadré et adapté à ses besoins. Chaque chien y est accueilli avec attention, dans un cadre favorisant son bien-être et sa socialisation.
                </span>
                <img src=" {{ asset('svg/illu_2.svg') }}" alt="petite fille qui carresse un chat"
                     class="
            absolute
            bottom-0 right-72
            lg:right-295
            w-30 sm:w-40 md:w-56 lg:w-64 xl:w-72
            translate-x-1/4 translate-y-1/4">
                <div class="flex justify-center">
                    <a href="#" class="bg-card-green text-cta hover:bg-hover p-3 lg:p-6 rounded-lg font-bold">Réserver une garde</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2>Comment se passent les séjours ? </h2>
    </section>
</div>
