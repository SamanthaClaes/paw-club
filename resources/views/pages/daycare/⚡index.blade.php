<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Notre garderie')]
class extends Component {
    public string $title = 'Paw Club';


};
?>

<div>
    <section class=" m-5 mx-5  lg:mt-20">
        <div class="flex flex-row-reverse gap-8 relative">
            <img src="{{ asset('img/hero_image.jpeg') }}"
                 alt="personne assise qui jouent avec des chiens de petites tailles"
                 class=" hidden lg:w-1/2  lg:object-cover lg:rounded-lg lg:block">
            <div class="border-5 border-element rounded-lg py-10">
                <h1 class=" text-text text-2xl text-center font-bold mb-4 lg:text-3xl">{{ $title }}</h1>
                <span class="block text-text text-sm text-center mb-5 lg:m-10">
                    La garderie qui fait sentir vos compagnons comme à la maison, même en votre absence
                </span>
                <p class="text-center text-sm text-text mb-5 line-clamp-2 lg:mb-10 lg:line-clamp-none">
                    PawClub est une garderie canine pensée pour offrir à votre compagnon un environnement sécurisé,
                    encadré et adapté à ses besoins. Chaque chien y est accueilli avec attention, dans un cadre
                    favorisant son bien-être et sa socialisation.
                </p>
                <img src=" {{ asset('svg/illu_2.svg') }}" alt="petite fille qui carresse un chat"
                     class="
            absolute
            bottom-0 right-72
            lg:right-295
            w-30 sm:w-40 md:w-56 lg:w-64 xl:w-72
            translate-x-1/4 translate-y-1/4">
                <div class="flex justify-center">
                    <a href="{{ route('daycare.create') }}"
                       class="bg-card-green text-cta hover:bg-hover p-3 lg:p-6 rounded-lg font-bold lg:w-1/2 lg:text-center lg:text-2xl uppercase">Réserver
                        une garde</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2 class="uppercase text-text text-lg lg:text-3xl text-center font-bold lg:mt-20 mb-6">Comment se passent les
            séjours ? </h2>
        <div class="relative">
            <img src="{{ asset('img/chihuahua.jpeg') }}" alt="chihuahua" height="150" width="150" class=" hidden object-cover
            lg:block
            rounded-full
            absolute top-45 right-150 border-15 border-white">
        </div>
        <div class="grid lg:grid-cols-2 gap-8 items-stretch auto-rows-fr">

            <div class="group flex flex-col justify-center items-center bg-card-pink rounded-lg h-full transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">
                <div class="mt-5 lg:mb-3 transition-transform duration-300 group-hover:scale-110">
                    <x-svg.icons.icons1/>
                </div>
                <div>
                    <p class="text-center text-sm/8 mb-5 lg:mb-20 pl-5 pr-5 pt-2 font-medium text-text-pink lg:text-xl/10 ">
                        PawClub met à disposition un espace vert sécurisé où les chiens peuvent se dépenser et profiter
                        des beaux jours.
                    </p>
                </div>
            </div>

            <div class="group flex flex-col justify-center items-center bg-card-orange rounded-lg h-full transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">
                <div class="mt-5 lg:mb-3 transition-transform duration-300 group-hover:scale-110">
                    <x-svg.icons.bell/>
                </div>
                <div>
                    <p class="text-center text-sm/8 mb-5 lg:mb-20 pl-5 pr-5 pt-2 font-medium text-text-orange lg:text-xl/10 ">
                        Nous proposons une alimentation adaptée, recommandée par nos vétérinaires, ou utilisons celle
                        que vous fournissez.
                    </p>
                </div>
            </div>

            <div class="group flex flex-col justify-center items-center bg-card-blue rounded-lg h-full transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">
                <div class="mt-5 lg:mb-3 transition-transform duration-300 group-hover:scale-110">
                    <x-svg.icons.health/>
                </div>
                <div>
                    <p class="text-center text-sm/8 mb-5 lg:mb-20 pl-5 pr-5 pt-2 font-medium text-text lg:text-xl/10 ">
                        Pour les séjours de plusieurs jours, votre compagnon est accueilli dans un espace adapté à la
                        saison.
                    </p>
                </div>
            </div>

            <div class="group flex flex-col justify-center items-center bg-card-green rounded-lg h-full transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">
                <div class="mt-5 lg:mb-3 transition-transform duration-300 group-hover:scale-110">
                    <x-svg.icons.home/>
                </div>
                <div>
                    <p class="text-center text-sm/8 mb-5 lg:mb-20 pl-5 pr-5 pt-2 font-medium text-cta lg:text-xl/10 ">
                        Nous proposons une alimentation adaptée, recommandée par nos vétérinaires, ou utilisons celle
                        que vous fournissez.
                    </p>
                </div>
            </div>

        </div>
    </section>
    <section>
        <h2 class="uppercase text-text text-lg lg:text-3xl text-center font-bold mt-10 lg:mt-20 mb-6">Vos compagnons en
            vacances</h2>
        <div class="overflow-x-auto flex md:grid lg:grid-cols-2 justify-center justify-items-center gap-8 mb-10 lg:mb-20 snap-x snap-mandatory pb-4 scrollbar-hide">
            <div class="w-[85%] md:w-auto shrink-0 md:shrink snap-center">
                <img src="{{ asset('img/food_dog.jpeg')}}" alt="homme remplissant une gamelle de croquette" height="308" width="552"  class=" aspect-3/2 object-cover rounded-lg transition duration-300 hover:scale-105 hover:shadow-xl">
            </div>
            <div class="w-[85%] md:w-auto shrink-0 md:shrink snap-center">
                <img src="{{ asset('img/playground.jpeg') }}" alt="chiens en train de jouer à la plaine de jeux pour chien" height="308" width="552" class=" aspect-3/2 object-cover rounded-lg transition duration-300 hover:scale-105 hover:shadow-xl">
            </div>
            <div class="w-[85%] md:w-auto shrink-0 md:shrink snap-center">
                <img src="{{ asset('img/woman_dog.jpeg') }}" alt="femme en train de jouer avec un chien dans un enclos" height="308" width="552" class=" aspect-3/2 object-cover rounded-lg transition duration-300 hover:scale-105 hover:shadow-xl">
            </div>
            <div class="w-[85%] md:w-auto shrink-0 md:shrink snap-center">
                <img src="{{ asset('img/run_dogs.jpeg') }}" alt="chiens en train de courir dans un vaste terrain d’herbe" height="308" width="552" class=" aspect-3/2 object-cover rounded-lg transition duration-300 hover:scale-105 hover:shadow-xl">
            </div>
            <div class="w-[85%] md:w-auto shrink-0 md:shrink snap-center">
                <img src="{{ asset('img/dogs.jpeg') }}" alt="chiens coucher sur des gros coussins" height="308" width="552" class=" aspect-3/2 object-cover rounded-lg transition duration-300 hover:scale-105 hover:shadow-xl">
            </div>
            <div class="w-[85%] md:w-auto shrink-0 md:shrink snap-center">
                <img src="{{ asset('img/playground_dogs2.jpeg') }}" alt="chiens en train de jouer à la plaine de jeux pour chien" height="308" width="552" class=" aspect-3/2 object-cover rounded-lg transition duration-300 hover:scale-105 hover:shadow-xl">
            </div>
        </div>
    </section>
    <section>
        <h2 class="uppercase text-text text-lg lg:text-3xl text-center font-bold mt-10 lg:mt-20 mb-6"> Où nous trouver ? </h2>
    </section>
</div>
