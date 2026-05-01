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
        <h2 class="uppercase text-text text-lg lg:text-3xl text-center font-bold lg:mt-20 mb-6">Comment cela fonctionne
            ? </h2>
        <div class="grid lg:grid-cols-2 justify-center justify-items-center gap-8 items-stretch auto-rows-fr ml-12">
            <div class=" flex justify-center items-center bg-card-orange  mr-12 lg:mr-0  rounded-lg h-full ">
                <div class="text-9xl text-text px-6">
                    1
                </div>
                <div>
                    <p class=" pl-5 pr-5 text-text-pink lg:text-xl/10 font-bold">Choisissez le petsitter de votre
                        choix</p>
                    <p class=" pl-5 pr-5  font-medium text-text-pink lg:text-xl/10">
                        Prenez contact avec le PetSitter de votre choix</p>
                </div>
            </div>
            <div class=" flex justify-center items-center bg-card-pink  mr-12 lg:mr-0  rounded-lg h-full ">
                <div class="text-9xl text-text px-6">
                    2
                </div>
                <div>
                    <p class=" pl-5 pr-5 text-text-pink lg:text-xl/10 font-bold">Rencontre avec le petsitter</p>
                    <p class=" pl-5 pr-5  font-medium text-text-pink lg:text-xl/10">
                        Après l’acceptation, une rencontre est prévue pour remettre les clés et les consignes.</p>
                </div>
            </div>
            <div class=" flex justify-center items-center bg-card-blue  mr-12 lg:mr-0  rounded-lg h-full ">
                <div class="text-9xl text-text px-6">
                    3
                </div>
                <div>
                    <p class=" pl-5 pr-5 text-text-pink lg:text-xl/10 font-bold">Petsitting</p>
                    <p class=" pl-5 pr-5  font-medium text-text-pink lg:text-xl/10">
                        Restez en contact avec le petsitter pendant la garde pour suivre le bon déroulement de celle-ci.</p>
                </div>
            </div>
            <div class=" flex justify-center items-center bg-card-green  mr-12 lg:mr-0  rounded-lg h-full ">
                <div class="text-9xl text-text px-6">
                    4
                </div>
                <div>
                    <p class=" pl-5 pr-5 text-text-pink lg:text-xl/10 font-bold">Paiement</p>
                    <p class=" pl-5 pr-5  font-medium text-text-pink lg:text-xl/10">
                        Le paiement est effectué avant la garde directement auprès de votre petsitter.</p>
                </div>
            </div>
        </div>
    </section>
</div>

