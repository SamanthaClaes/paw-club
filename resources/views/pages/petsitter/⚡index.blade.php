<?php

use App\enum\UserRole;
use App\Enums\PetsitterStatus;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Petsitter')]
class extends Component {
    public string $title = 'Vous chercher un petsitter ?';
    public $petsitters;

    public function mount(): void
    {
        $this->petsitters = User::where('role', UserRole::PETSITTER)->where('petsitter_status', PetsitterStatus::ACCEPTED)->get();
    }
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
                        {{ __('petsitter.subtitle') }}
                </span>
                <p class="text-center text-sm text-text mb-5 line-clamp-2 lg:mb-10 lg:line-clamp-none">
                    {{ __('petsitter.description') }}
                </p>
                <img src=" {{ asset('svg/illu_5.svg') }}" alt="homme et femme donnant à manger à un chat"
                     class="
            absolute
            bottom-10 left-260
            lg:right-295
            xl:left-150
            w-30 sm:w-40 md:w-56 lg:w-64 xl:w-72
            translate-x-1/4 translate-y-1/4">
                <div class="flex justify-center">
                    <a href="{{ route('petsitter.index') }}#petsitters_list"
                       class="bg-card-green text-cta hover:bg-hover p-3 lg:p-6 rounded-lg font-bold lg:w-1/2 lg:text-center lg:text-2xl uppercase">{{ __('petsitter.schedulePetsitter') }}</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2 class="uppercase text-text text-lg lg:text-3xl text-center font-bold lg:mt-20 mb-6">
            {{ __('petsitter.fonction') }}
        </h2>

        <div class="grid lg:grid-cols-2 gap-8 items-stretch auto-rows-fr">

            <div
                class="flex items-center gap-4 bg-card-orange rounded-lg p-5 h-full relative overflow-hidden lg:ml-25 min-h-40 lg:min-h-50 bg-[url(/public/svg/paws_icons.svg)] bg-repeat bg-center shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">
            <span
                class="text-7xl font-bold text-text-orange leading-none shrink-0 [text-shadow:0_4px_4px_rgba(0,0,0,0.25)]">
                1
            </span>

                <div>
                    <p class="text-text-orange font-bold text-base lg:text-lg">
                            {{ __('petsitter.choosePetsitter') }}
                    </p>
                    <p class="text-text-orange text-sm lg:text-base font-medium">
                            {{ __('petsitter.cardText') }}
                    </p>
                </div>

            </div>

            <div
                class="flex items-center gap-4 bg-card-pink rounded-lg p-5 h-full relative overflow-hidden lg:mr-25 min-h-40 lg:min-h-50 bg-[url(/public/svg/paws_icons_rose.svg)] bg-repeat bg-center shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">

            <span
                class="text-7xl font-bold text-text-pink leading-none shrink-0 [text-shadow:0_4px_4px_rgba(0,0,0,0.25)]">
                2
            </span>

                <div>
                    <p class="text-text-pink font-bold text-base lg:text-lg">
                        {{ __('petsitter.meetPetsitter') }}
                    </p>
                    <p class="text-text-pink text-sm lg:text-base font-medium">
                            {{ __('petsitter.cardTextTwo') }}
                    </p>
                </div>

            </div>

            <div
                class="flex items-center gap-4 bg-element rounded-lg p-5 h-full relative overflow-hidden lg:ml-25 min-h-40 lg:min-h-50 bg-[url(/public/svg/paws_icon_blue.svg)] bg-repeat bg-center shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">

            <span class="text-7xl font-bold text-text leading-none shrink-0 [text-shadow:0_4px_4px_rgba(0,0,0,0.25)]">
                3
            </span>

                <div>
                    <p class="text-text font-bold text-base lg:text-lg">
                            {{ __('petsitter.petsitting') }}
                    </p>
                    <p class="text-text text-sm lg:text-base font-medium">
                            {{ __('petsitter.cardTextThree') }}
                    </p>
                </div>

            </div>


            <div
                class="flex items-center gap-4 bg-card-green rounded-lg p-5 h-full relative overflow-hidden lg:mr-25 min-h-40 lg:min-h-50 bg-[url(/public/svg/paws_icon_green.svg)] bg-repeat bg-center shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">

            <span class="text-7xl font-bold text-cta leading-none shrink-0 [text-shadow:0_4px_4px_rgba(0,0,0,0.25)]">
                4
            </span>

                <div>
                    <p class="text-cta font-bold text-base lg:text-lg">
                        {{ __('petsitter.paid') }}
                    </p>
                    <p class="text-cta text-sm lg:text-base font-medium">
                        {{ __('petsitter.cardTextFour') }}
                    </p>
                </div>
            </div>

        </div>
    </section>
    <section>
        <h2 id="petsitters_list"
            class="uppercase text-text text-lg lg:text-3xl text-center font-bold lg:mt-20 mb-6 mt-6"> {{ __('petsitter.discoverPetsitter') }}</h2>
        @foreach($petsitters as $petsitter)
            <x-cards.petsitter_card
                :name="$petsitter->first_name"
                :image="$petsitter->image"
                :description="$petsitter->description"
                :tags="[...$petsitter->animalTypes->pluck('type')->toArray(),$petsitter->habitation?->name]"
                :choose-url="route('petsitter.booking.create', ['user' => $petsitter->id])"
                :contact-url="route('petsitter.request', $petsitter)"
            />
        @endforeach
    </section>
    <section
        class="relative flex flex-col items-center gap-4 bg-card-green rounded-lg p-4 lg:p-5 ml-4 mr-4 lg:ml-25 lg:mr-25 min-h-40 lg:min-h-50 my-20 shadow">

        <h3 class="mt-16 mb-8 text-text lg:text-3xl font-semibold text-center">
                {{ __('petsitter.cardTitle') }}
        </h3>

        <p class="lg:w-1/2 my-12 text-center">
                {{ __('petsitter.cardSubtitle') }}
        </p>

        <a href="{{ route('petsitter.create') }}"
           class="text-lg lg:text-3xl text-center w-full lg:w-1/2 bg-white lg:py-4 lg:px-18 rounded-lg uppercase font-bold text-text ">
                {{ __('petsitter.cardCta') }}
        </a>

        <img src="{{ asset('svg/ill_6.svg') }}" alt="illustration d'une femme qui caresse un chat"
             class="hidden sm:block absolute bottom-5 right-255 xl:right-390 w-30 sm:w-40 md:w-56 lg:w-80 translate-x-1/4 translate-y-1/4">
        <img src="{{ asset('svg/ill_7.svg') }}" alt=" illustration d'une femme en train de promener un chien brun"
             class="hidden sm:block absolute bottom-5 left-220 xl:left-350 w-30 sm:w-40 md:w-56 lg:w-80 translate-x-1/4 translate-y-1/4">
    </section>
</div>

