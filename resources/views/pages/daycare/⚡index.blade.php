<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Notre garderie | Paw-club')]
class extends Component {
    public string $title = 'Paw Club';


};
?>

<div>
    <section class="mx-5 mt-6 lg:mt-20">

        <div class="relative flex flex-col lg:flex-row-reverse gap-8 items-stretch">

            <img
                src="{{ asset('img/hero_daycare_image.webp') }}"
                alt="personne assise qui jouent avec des chiens de petites tailles"
                class="hidden lg:block lg:w-1/2 object-cover rounded-3xl shadow-lg"
            >

            <div
                class="relative flex flex-col justify-center
            border-4 border-element
            rounded-3xl
            px-6 py-10  lg:px-12 lg:py-14
            overflow-hidden  shadow-lg lg:w-1/2">

                <div class="absolute inset-0 bg-linear-to-br from-white/5 to-transparent pointer-events-none"></div>

                <h1
                    class="relative z-10 text-text text-2xl lg:text-4xl text-center font-extrabold leading-tight">
                    {{ $title }}
                </h1>

                <span
                    class="relative z-10 block text-text text-sm lg:text-base text-center mt-6 max-w-2xl mx-auto leading-7">
                {{ __('daycare.subtitle') }}
            </span>

                <p
                    class="relative z-10 text-center text-sm lg:text-base text-text mt-8 mb-10 leading-7 max-w-2xl mx-auto">
                    {{ __('daycare.about') }}
                </p>

                <img
                    src="{{ asset('svg/illu_2.webp') }}"
                    alt="petite fille qui carresse un chat"
                    class="absolute
                    hidden
                    lg:block
                bottom-0 left-0
                w-40 lg:w-40 xl:w-40
                opacity-95 pointer-events-none"
                >

                <div class="relative z-10 flex justify-center">

                    <a
                        href="{{ route('daycare.request') }}"
                        class="bg-card-green text-cta hover:bg-hover
                        hover:text-white
                    px-8 py-4 lg:px-12
                    rounded-2xl
                    font-extrabold uppercase tracking-wide
                    text-sm lg:text-xl
                    shadow-md hover:shadow-lg hover:-translate-y-1
                    transition-all duration-300"
                    >
                        {{ __('daycare.schedule') }}
                    </a>

                </div>

            </div>

        </div>

    </section>
    <section class="mt-10 lg:mt-0">

        <h2 class="uppercase text-text text-xl lg:text-4xl text-center font-extrabold lg:mt-20 mb-6">
            {{ __('daycare.going') }}
        </h2>

        <div class="relative max-w-7xl mx-auto">

            <img
                src="{{ asset('img/chihuahua.webp') }}"
                alt="chihuahua"
                height="150"
                width="150"
                class="hidden lg:block object-cover
            rounded-full
            absolute top-1/2 left-1/2
            -translate-x-1/2 -translate-y-1/2
            border-8 border-white
             z-20"
            >
            <x-cards.daycare_section_cards/>
        </div>
    </section>
    <section class="mt-10 lg:mt-0">
        <h2 class="uppercase text-text text-xl lg:text-4xl text-center font-extrabold lg:mt-20 mb-3">
            {{ __('daycare.priceTitle') }}
        </h2>
        <span class="text-center block mb-6 text-text text-xl">{{ __('daycare.priceAdvice') }}</span>
            <x-cards.daycare_pricing_section/>
    </section>
    <section>

        <h2 class="uppercase text-text text-xl lg:text-4xl text-center font-extrabold lg:mt-20 mb-6">
                {{ __('daycare.yourDogs') }}
        </h2>

        <div class="flex justify-center items-center overflow-hidden">

            <div
                class="
                flex items-center py-16
                transition-transform duration-700 ease-out

                motion-safe:animate-[cardsReveal_1.2s_ease-out]
            "
            >

                <div
                    class="
                    relative z-10

                    -mr-16
                    rotate-[-10deg]

                    sm:-mr-22
                    sm:rotate-[-14deg]

                    lg:mr-0
                    lg:rotate-[-18deg]

                    transition-transform duration-500 ease-out

                    hover:z-50
                    hover:-translate-y-8
                    hover:-translate-x-4
                    hover:mr-8
                "
                >
                    <img
                        src="{{ asset('img/food_dog.webp')}}"
                        alt="chien mangeant dans une gamelle"
                        class="
                        w-32 h-56
                        sm:w-38 sm:h-70
                        lg:w-67.5 lg:h-130

                        rounded-4xl
                        lg:rounded-xl

                        object-cover
                        shadow-2xl
                    "
                    >
                </div>

                <div
                    class="
                    relative z-20

                    -ml-10 -mr-16
                    rotate-[-5deg]

                    sm:-ml-16 sm:-mr-22
                    sm:rotate-[-8deg]

                    lg:-ml-20 lg:mr-0
                    lg:-rotate-10

                    transition-transform duration-500 ease-out

                    hover:z-50
                    hover:-translate-y-8
                    hover:-translate-x-2
                    hover:ml-4
                    hover:mr-10
                "
                >
                    <img
                        src="{{ asset('img/playground.webp')}}"
                        alt="chiens jouant dans une plaine de jeux"
                        class="
                        w-36 h-64
                        sm:w-42 sm:h-78
                        lg:w-75 lg:h-145

                        rounded-4xl
                        lg:rounded-xl

                        object-cover
                        shadow-2xl
                    "
                    >
                </div>

                <div
                    class="
                    relative z-30

                    -ml-10 -mr-10

                    sm:-ml-16 sm:-mr-16

                    lg:-ml-20 lg:mr-0

                    transition-transform duration-500 ease-out

                    hover:z-50
                    hover:-translate-y-8
                    hover:mx-8
                "
                >
                    <img
                        src="{{ asset('img/woman_dog.webp')}}"
                        alt="femme jouant avec un chien"
                        class="
                        w-40 h-72
                        sm:w-48 sm:h-88
                        lg:w-85 lg:h-160

                       rounded-4xl
lg:rounded-4xl

                        object-cover
                        shadow-2xl
                    "
                    >
                </div>

                <div
                    class="
                    relative z-20

                    -ml-10 -mr-16
                    rotate-5

                    sm:-ml-16 sm:-mr-22
                    sm:rotate-8

                    lg:-ml-20 lg:mr-0
                    lg:rotate-10

                    transition-transform duration-500 ease-out

                    hover:z-50
                    hover:-translate-y-8
                    hover:translate-x-2
                    hover:ml-10
                    hover:mr-4
                "
                >
                    <img
                        src="{{ asset('img/run_dogs.webp')}}"
                        alt="chiens courant dans l’herbe"
                        class="
                        w-36 h-64
                        sm:w-42 sm:h-78
                        lg:w-75 lg:h-145

                        rounded-4xl
                        lg:rounded-xl

                        object-cover
                        shadow-2xl
                    "
                    >
                </div>

                <div
                    class="
                    relative z-10

                    -ml-10
                    rotate-10

                    sm:-ml-16
                    sm:rotate-14

                    lg:-ml-20
                    lg:rotate-18

                    transition-transform duration-500 ease-out

                    hover:z-50
                    hover:-translate-y-8
                    hover:translate-x-4
                    hover:ml-8
                "
                >
                    <img
                        src="{{ asset('img/dogs.webp')}}"
                        alt="chiens couchés sur des coussins"
                        class="
                        w-32 h-56
                        sm:w-38 sm:h-70
                        lg:w-67.5 lg:h-130

                        rounded-4xl
                        lg:rounded-xl

                        object-cover
                        shadow-2xl
                    "
                    >
                </div>

            </div>

        </div>

    </section>
    <section>
        <h2 class="uppercase text-text text-lg lg:text-3xl text-center font-bold mt-10 lg:mt-20 mb-6"> {{ __('daycare.place') }}</h2>
        <x-maps.maps/>
    </section>
</div>
