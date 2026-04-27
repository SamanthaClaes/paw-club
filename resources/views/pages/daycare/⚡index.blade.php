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
                <span class="block text-text text-sm text-center mb-5 lg:m-10">
                    La garderie qui fait sentir vos compagnons comme à la maison, même en votre absence
                </span>
                <p class="text-center text-sm text-text mb-5 line-clamp-2 lg:mb-10 lg:line-clamp-none">
                    PawClub est une garderie canine pensée pour offrir à votre compagnon un environnement sécurisé, encadré et adapté à ses besoins. Chaque chien y est accueilli avec attention, dans un cadre favorisant son bien-être et sa socialisation.
                </p>
                <img src=" {{ asset('svg/illu_2.svg') }}" alt="petite fille qui carresse un chat"
                     class="
            absolute
            bottom-0 right-72
            lg:right-295
            w-30 sm:w-40 md:w-56 lg:w-64 xl:w-72
            translate-x-1/4 translate-y-1/4">
                <div class="flex justify-center">
                    <a href="#" class="bg-card-green text-cta hover:bg-hover p-3 lg:p-6 rounded-lg font-bold lg:w-1/2 lg:text-center lg:text-2xl uppercase">Réserver une garde</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2 class="uppercase text-text text-lg lg:text-5xl text-center font-bold lg:mt-20 mb-6">Comment se passent les séjours ? </h2>
        <div class="grid lg:grid-cols-2 justify-center justify-items-center gap-8" >
            <div class="flex flex-col justify-center items-center bg-card-pink ml-12 mr-12 lg:ml-25  rounded-lg ">
                <div class="mt-5 lg:mb-3">
                    <x-svg.icons.icons1/>
                </div>
                <div>
                   <p class="text-center text-sm/8 mb-5 lg:mb-20 pl-5 pr-5 pt-2 font-medium text-text-pink ">PawClub met à disposition un espace vert sécurisé où les chiens peuvent se dépenser et profiter des beaux jours.</p>
                </div>
            </div>
            <div>2</div>
            <div>3</div>
            <div>4</div>
        </div>
    </section>
</div>
