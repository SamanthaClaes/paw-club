<?php

use App\Enums\PetsitterStatus;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Petsitter')]
class extends Component {
    public $petsitters;

    public function mount(): void
    {
        $this->petsitters = User::with([
            'animalTypes',
            'habitation',
        ])
            ->where('is_petsitter', true)
            ->where('petsitter_status', PetsitterStatus::ACCEPTED)
            ->get();
    }
};
?>


<div>
    <section class="mx-5 lg:mt-20">

        <div
            class="relative flex flex-col lg:flex-row gap-8 items-stretch">

            <img
                src="{{ asset('img/petsitter.webp') }}"
                alt="un homme et une femme en train de câliner un chien blanc"
                class="hidden lg:block lg:w-1/2 object-cover rounded-3xl shadow-lg"
            >

            <div
                class="relative flex flex-col justify-center
            border-4 border-element
            rounded-3xl
            px-6 py-10 lg:px-12 lg:py-14
            overflow-hidden  shadow-lg lg:w-1/2">

                <div class="absolute inset-0 bg-linear-to-br from-white/5 to-transparent pointer-events-none"></div>

                <h1
                    class="relative z-10 text-text text-2xl lg:text-4xl text-center font-extrabold leading-tight">
                    {{ __('petsitter.title') }}
                </h1>

                <span
                    class="relative z-10 block text-text text-sm lg:text-base text-center mt-6 max-w-2xl mx-auto leading-7">
                {{ __('petsitter.subtitle') }}
            </span>

                <p
                    class="relative z-10 text-center text-sm lg:text-base text-text mt-8 mb-10 leading-7 max-w-xl mx-auto">
                    {{ __('petsitter.description') }}
                </p>

                <img
                    src="{{ asset('svg/illu_5.svg') }}"
                    alt="homme et femme donnant à manger à un chat"
                    class="hidden lg:block absolute
                bottom-5 right-0
                w-40 xl:w-56
                translate-y-1/5
                opacity-95 pointer-events-none"
                >

                <div class="relative z-10 flex justify-center">

                    <a
                        href="{{ route('petsitter.index') }}#petsitters_list"
                        class="bg-card-green text-cta hover:bg-hover
                        hover:text-white
                    px-8 py-4 lg:px-12
                    rounded-2xl
                    font-extrabold uppercase tracking-wide
                    text-sm lg:text-xl
                    shadow-md hover:shadow-lg hover:-translate-y-1
                    transition-all duration-300"
                    >
                        {{ __('petsitter.schedulePetsitter') }}
                    </a>

                </div>

            </div>

        </div>

    </section>
    <section class="mt-10 lg:mt-0">

        <h2 class="uppercase text-text text-xl lg:text-4xl text-center font-extrabold lg:mt-20 mb-10">
            {{ __('petsitter.fonction') }}
        </h2>

        <div class="grid lg:grid-cols-2 gap-8 items-stretch auto-rows-fr">

            <div
                class="group flex items-center gap-5
            bg-card-orange rounded-3xl
            p-6 lg:p-8
            h-full relative overflow-hidden
            lg:ml-25 min-h-44 lg:min-h-56
            bg-[url(/public/svg/paws_icons.svg)] bg-repeat bg-center
            shadow-lg border border-white/20
            transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">

                <div class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent pointer-events-none"></div>

                <span
                    class="relative z-10 text-7xl lg:text-8xl font-black text-text-orange leading-none shrink-0
                [text-shadow:0_4px_10px_rgba(0,0,0,0.20)] group-hover:scale-110 transition-transform duration-300">
                1
            </span>

                <div class="relative z-10">

                    <p class="text-text-orange font-extrabold text-lg lg:text-2xl mb-2">
                        {{ __('petsitter.choosePetsitter') }}
                    </p>

                    <p class="text-text-orange text-sm lg:text-base font-medium leading-7">
                        {{ __('petsitter.cardText') }}
                    </p>

                </div>

            </div>

            <div
                class="group flex items-center gap-5
            bg-card-pink rounded-3xl
            p-6 lg:p-8
            h-full relative overflow-hidden
            lg:mr-25 min-h-44 lg:min-h-56
            bg-[url(/public/svg/paws_icons_rose.svg)] bg-repeat bg-center
            shadow-lg border border-white/20
            transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">

                <div class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent pointer-events-none"></div>

                <span
                    class="relative z-10 text-7xl lg:text-8xl font-black text-text-pink leading-none shrink-0
                [text-shadow:0_4px_10px_rgba(0,0,0,0.20)] group-hover:scale-110 transition-transform duration-300">
                2
            </span>

                <div class="relative z-10">

                    <p class="text-text-pink font-extrabold text-lg lg:text-2xl mb-2">
                        {{ __('petsitter.meetPetsitter') }}
                    </p>

                    <p class="text-text-pink text-sm lg:text-base font-medium leading-7">
                        {{ __('petsitter.cardTextTwo') }}
                    </p>

                </div>

            </div>

            <div
                class="group flex items-center gap-5
            bg-element rounded-3xl
            p-6 lg:p-8
            h-full relative overflow-hidden
            lg:ml-25 min-h-44 lg:min-h-56
            bg-[url(/public/svg/paws_icon_blue.svg)] bg-repeat bg-center
            shadow-lg border border-white/20
            transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">

                <div class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent pointer-events-none"></div>

                <span
                    class="relative z-10 text-7xl lg:text-8xl font-black text-text leading-none shrink-0
                [text-shadow:0_4px_10px_rgba(0,0,0,0.20)] group-hover:scale-110 transition-transform duration-300">
                3
            </span>

                <div class="relative z-10">

                    <p class="text-text font-extrabold text-lg lg:text-2xl mb-2">
                        {{ __('petsitter.petsitting') }}
                    </p>

                    <p class="text-text text-sm lg:text-base font-medium leading-7">
                        {{ __('petsitter.cardTextThree') }}
                    </p>

                </div>

            </div>

            <div
                class="group flex items-center gap-5
            bg-card-green rounded-3xl
            p-6 lg:p-8
            h-full relative overflow-hidden
            lg:mr-25 min-h-44 lg:min-h-56
            bg-[url(/public/svg/paws_icon_green.svg)] bg-repeat bg-center
            shadow-lg border border-white/20
            transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">

                <div class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent pointer-events-none"></div>

                <span
                    class="relative z-10 text-7xl lg:text-8xl font-black text-cta leading-none shrink-0
                [text-shadow:0_4px_10px_rgba(0,0,0,0.20)] group-hover:scale-110 transition-transform duration-300">
                4
            </span>

                <div class="relative z-10">

                    <p class="text-cta font-extrabold text-lg lg:text-2xl mb-2">
                        {{ __('petsitter.paid') }}
                    </p>

                    <p class="text-cta text-sm lg:text-base font-medium leading-7">
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
                :choose-url=" route('petsitter.booking.create', ['user' => $petsitter->id])"
                :contact-url=" route('petsitter.contact', ['user' => $petsitter->id])"
            />
        @endforeach
    </section>
    <section
        class="relative overflow-hidden flex flex-col items-center text-center
    bg-card-green rounded-lg
    px-6 py-10 lg:px-12 lg:py-14
    mx-4 lg:mx-20 my-20
    shadow-lg border border-white/20">

        <div class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent pointer-events-none"></div>

        <h3 class="relative z-10 text-text text-2xl lg:text-4xl font-extrabold leading-tight max-w-2xl">
            {{ __('petsitter.cardTitle') }}
        </h3>

        <p class="relative z-10 mt-6 max-w-2xl text-sm lg:text-lg leading-7 text-text/90">
            {{ __('petsitter.cardSubtitle') }}
        </p>

        <a
            href="{{ route('petsitter.create') }}"
            class="relative z-10 mt-8
        bg-white text-text
        text-sm lg:text-xl
        font-extrabold uppercase tracking-wide
        px-8 py-4 lg:px-12
        rounded-2xl
        shadow-md
        hover:-translate-y-1 hover:shadow-lg
        transition-all duration-300"
        >
            {{ __('petsitter.cardCta') }}
        </a>

        <img
            src="{{ asset('svg/ill_6.svg') }}"
            alt="illustration d'une femme qui caresse un chat"
            class="hidden lg:block absolute
        bottom-0 left-0
        w-48 xl:w-64
        -translate-x-1/5 translate-y-1/6
        opacity-95 pointer-events-none"
        >

        <img
            src="{{ asset('svg/ill_7.svg') }}"
            alt="illustration d'une femme promenant un chien brun"
            class="hidden lg:block absolute
        bottom-0 right-0
        w-48 xl:w-64
        translate-x-1/5 translate-y-1/6
        opacity-95 pointer-events-none"
        >

    </section>
</div>

