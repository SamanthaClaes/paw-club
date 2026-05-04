<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Petsitter')]
class extends Component {
    public string $title = 'Vous chercher un petsitter ?';
};
?>


<div>
    <section class=" m-5 mx-5 lg:mt-20">
        <div class="flex flex-row gap-8 relative">
            <img src="{{ asset('img/petsitter.jpeg') }}"
                 alt="un homme et une femme en train de câliner un chien blanc"
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
                <img src=" {{ asset('svg/illu_5.svg') }}" alt="homme et femme donnant à manger à un chat"
                     class="
            absolute
            bottom-10 left-260
            lg:right-295
            w-30 sm:w-40 md:w-56 lg:w-64 xl:w-72
            translate-x-1/4 translate-y-1/4">
                <div class="flex justify-center">
                    <a href="{{ route('daycare.create') }}"
                       class="bg-card-green text-cta hover:bg-hover p-3 lg:p-6 rounded-lg font-bold lg:w-1/2 lg:text-center lg:text-2xl uppercase">Réserver
                        un petsitter</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2 class="uppercase text-text text-lg lg:text-3xl text-center font-bold lg:mt-20 mb-6">
            Comment cela fonctionne ?
        </h2>

        <div class="grid lg:grid-cols-2 gap-8 items-stretch auto-rows-fr">

            <div class="flex items-center gap-4 bg-card-orange rounded-lg p-5 h-full relative overflow-hidden lg:ml-25 min-h-40 lg:min-h-50 bg-[url(/public/svg/paws_icons.svg)] bg-repeat bg-center shadow-lg">
            <span class="text-7xl font-bold text-text-orange leading-none shrink-0 [text-shadow:0_4px_4px_rgba(0,0,0,0.25)]">
                1
            </span>

                <div>
                    <p class="text-text-orange font-bold text-base lg:text-lg">
                        Choisissez votre petsitter
                    </p>
                    <p class="text-text-orange text-sm lg:text-base font-medium">
                        Prenez contact avec le PetSitter de votre choix
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-4 bg-card-pink rounded-lg p-5 h-full relative overflow-hidden lg:mr-25 min-h-40 lg:min-h-50 bg-[url(/public/svg/paws_icons_rose.svg)] bg-repeat bg-center shadow-lg">

            <span class="text-7xl font-bold text-text-pink leading-none shrink-0 [text-shadow:0_4px_4px_rgba(0,0,0,0.25)]">
                2
            </span>

                <div>
                    <p class="text-text-pink font-bold text-base lg:text-lg">
                        Rencontre avec le petsitter
                    </p>
                    <p class="text-text-pink text-sm lg:text-base font-medium">
                        Après l’acceptation, une rencontre est prévue pour remettre les clés et les consignes.
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-4 bg-element rounded-lg p-5 h-full relative overflow-hidden lg:ml-25 min-h-40 lg:min-h-50 bg-[url(/public/svg/paws_icon_blue.svg)] bg-repeat bg-center shadow-lg">

            <span class="text-7xl font-bold text-text leading-none shrink-0 [text-shadow:0_4px_4px_rgba(0,0,0,0.25)]">
                3
            </span>

                <div>
                    <p class="text-text font-bold text-base lg:text-lg">
                        Petsitting
                    </p>
                    <p class="text-text text-sm lg:text-base font-medium">
                        Restez en contact avec le petsitter pendant la garde pour suivre le bon déroulement de celle-ci.
                    </p>
                </div>

            </div>


            <div class="flex items-center gap-4 bg-card-green rounded-lg p-5 h-full relative overflow-hidden lg:mr-25 min-h-40 lg:min-h-50 bg-[url(/public/svg/paws_icon_green.svg)] bg-repeat bg-center shadow-lg">

            <span class="text-7xl font-bold text-cta leading-none shrink-0 [text-shadow:0_4px_4px_rgba(0,0,0,0.25)]">
                4
            </span>

                <div>
                    <p class="text-cta font-bold text-base lg:text-lg">
                        Paiement
                    </p>
                    <p class="text-cta text-sm lg:text-base font-medium">
                        Le paiement est effectué avant la garde directement auprès de votre petsitter.
                    </p>
                </div>
            </div>

        </div>
    </section>
    <section>
        <h2 class="uppercase text-text text-lg lg:text-3xl text-center font-bold lg:mt-20 mb-6"> Découvrez nos petsitters</h2>
        {{--@foreach($petsitters as $petsitter)
            <x-card
                :name="$petsitter->name"
                :image="$petsitter->image"
                :description="$petsitter->description"
                :tags="$petsitter->tags"
                :choose-url="route('ajouter la route', $petsitter)"
                :contact-url="route('ajouter la route', $petsitter)"
            />
        @endforeach--}}
    </section>
    <section class="flex flex-col items-center gap-4 bg-card-green rounded-lg p-5 ml-25 mr-25 min-h-40 lg:min-h-50">
        <h3 class="mt-16 mb-8 text-text text-3xl font-semibold">Vous souhaitez devenir petsitter ? </h3>
        <p class=" lg:w-1/2 my-12">Envie de vous occuper d’animaux ? Rejoignez PawClub et devenez petsitter en proposant un service adapté à vos disponibilités.</p>
        <a href="" class=" text-center w-1/2 bg-white py-4 px-18 rounded-lg uppercase font-bold text-text">Devenir petsitter</a>
    </section>
</div>

