<?php

use App\Enums\PetsitterStatus;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Petsitter')]
class extends Component {
    use WithPagination;

    public $query = '';

    public function search()
    {
        $this->resetPage();
    }

    #[Computed]
    public function petsitters(): array|LengthAwarePaginator
    {
        return $this->petsitters = User::with([
            'animalTypes',
            'habitation',
        ])
            ->where('is_petsitter', true)
            ->where('petsitter_status', PetsitterStatus::ACCEPTED)
            ->paginate(4);
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

            <div class="lg:ml-25">

                <x-cards.steps_cards
                    number="1"
                    :title="__('petsitter.choosePetsitter')"
                    :description="__('petsitter.cardText')"
                    bgColor="bg-card-orange"
                    textColor="text-text-orange"
                    backgroundPattern="bg-[url(/public/svg/paws_icons.svg)] bg-repeat bg-center"
                />

            </div>

            <div class="lg:mr-25">

                <x-cards.steps_cards
                    number="2"
                    :title="__('petsitter.meetPetsitter')"
                    :description="__('petsitter.cardTextTwo')"
                    bgColor="bg-card-pink"
                    textColor="text-text-pink"
                    backgroundPattern="bg-[url(/public/svg/paws_icons_rose.svg)] bg-repeat bg-center"
                />

            </div>

            <div class="lg:ml-25">

                <x-cards.steps_cards
                    number="3"
                    :title="__('petsitter.petsitting')"
                    :description="__('petsitter.cardTextThree')"
                    bgColor="bg-element"
                    textColor="text-text"
                    backgroundPattern="bg-[url(/public/svg/paws_icon_blue.svg)] bg-repeat bg-center"
                />

            </div>

            <div class="lg:mr-25">

                <x-cards.steps_cards
                    number="4"
                    :title="__('petsitter.paid')"
                    :description="__('petsitter.cardTextFour')"
                    bgColor="bg-card-green"
                    textColor="text-cta"
                    backgroundPattern="bg-[url(/public/svg/paws_icon_green.svg)] bg-repeat bg-center"
                />

            </div>

        </div>

    </section>
    <section>
        <h2 id="petsitters_list"
            class="uppercase text-text text-lg lg:text-3xl text-center font-bold lg:mt-30 mb-6 mt-6"> {{ __('petsitter.discoverPetsitter') }}
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
        @foreach($this->petsitters as $petsitter)
            <x-cards.petsitter_card
                :name="$petsitter->first_name"
                :image="$petsitter->image"
                :description="$petsitter->description"
                :tags="[...$petsitter->animalTypes->pluck('type')->toArray(),$petsitter->habitation?->name]"
                :choose-url=" route('petsitter.booking.create', ['user' => $petsitter->id])"
                :contact-url=" route('petsitter.contact', ['user' => $petsitter->id])"
            />
        @endforeach
        </div>
        <div class="mt-12 flex justify-center">
        {{ $this->petsitters->links() }}
        </div>
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

