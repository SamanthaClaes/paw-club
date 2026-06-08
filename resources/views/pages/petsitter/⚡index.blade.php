<?php

use App\Enums\PetsitterStatus;
use App\Models\AnimalType;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Petsitter | Paw-club')]
class extends Component {
    use WithPagination;

    public $search = '';

    public $location = '';

    public $animalType = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function animalTypes(): Collection
    {
        return AnimalType::all();
    }

    #[Computed]
    public function locations(): Collection
    {
        return $this->petsitterQuery()
            ->select('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');
    }


    public function petsitterQuery(): Builder
    {
        return User::with([
            'animalTypes',
            'habitation',
        ])
            ->where('is_petsitter', true)
            ->where('petsitter_status', PetsitterStatus::ACCEPTED);
    }

    #[Computed]
    public function petsitters(): array|LengthAwarePaginator
    {
        return $this->petsitterQuery()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%")
                        ->orWhere('location', 'like', "%{$this->search}%");
                });
            })
            ->when($this->location, function ($query) {
                $query->where('location', $this->location);
            })
            ->when($this->animalType, function ($query) {
                $query->whereHas('animalTypes', function ($q) {
                    $q->where('animal_types.id', $this->animalType);
                });
            })
            ->latest()
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
            border-2 border-element
            rounded-3xl
            px-6 py-10 m-3 lg:m-0
            overflow-hidden  shadow-lg lg:w-1/2">

                <div class="absolute inset-0 bg-linear-to-br from-white/5 to-transparent pointer-events-none"></div>

                <h1
                    class="relative z-10 text-text text-2xl lg:text-4xl text-center font-extrabold leading-tight">
                    {{ __('petsitter.title') }}
                </h1>


                <p
                    class="relative z-10 text-center text-sm lg:text-base text-text mt-8 mb-10 leading-7 max-w-xl mx-auto">
                    {{ __('petsitter.description') }}
                </p>

                <img
                    src="{{ asset('svg/illu_5.webp') }}"
                    alt="homme et femme donnant à manger à un chat"
                    class="hidden lg:block absolute
                bottom-5 right-0
                w-40 xl:w-40
                translate-y-6
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
            <x-cards.all_cards_steps/>
        </div>
    </section>


    <section>

        <h2 id="petsitters_list"
            class="uppercase text-text text-lg lg:text-3xl text-center font-bold lg:mt-30 mb-6 mt-6"> {{ __('petsitter.discoverPetsitter') }}
        </h2>


        <div class="max-w-6xl ml-8 px-4 mb-6">

            <div class="flex flex-col lg:flex-row gap-8 items-center">

                <x-search.search
                    search="search"
                />

                <div class="w-full lg:w-64">

                    <x-forms.select-option
                        name="location"
                        id="location"
                        wire:model.live="location"
                        label="{{ __('petsitter.location') }}"
                    >
                        <option value="">{{ __('petsitter.allLocation') }}</option>
                        @foreach($this->locations as $location)
                            <option value="{{ $location }}"> {{ $location }}</option>
                        @endforeach
                    </x-forms.select-option>

                </div>

                <div class="w-full lg:w-64">

                    <x-forms.select-option
                        name="animalType"
                        id="animalType"
                        wire:model.live="animalType"
                        label="{{ __('petsitter.animalType') }}"
                    >
                        <option value="">{{ __('petsitter.animals') }}</option>
                        @foreach($this->animalTypes as $animalType)
                            <option
                                value="{{ $animalType->id }}">{{ ucfirst( __('animalTypes.' . $animalType->type)) }}</option>
                        @endforeach
                    </x-forms.select-option>

                </div>

            </div>

        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch m-10">
            @foreach($this->petsitters as $petsitter)
                <x-cards.petsitter_card
                    :name="$petsitter->first_name"
                    :last="$petsitter->last_name"
                    :location="$petsitter->location"
                    :price="$petsitter->price"
                    :image="$petsitter->image"
                    :description="$petsitter->description"
                    :tags="[...$petsitter->animalTypes->map(fn ($animalType) => __('animalTypes.' . $animalType->type))->toArray(), __('habitationType.' . $petsitter->habitation?->name)]"
                    :choose-url=" route('petsitter.booking.create', ['user' => $petsitter->id])"
                    :contact-url=" route('petsitter.contact', ['user' => $petsitter->id])"
                    :petsitter="$petsitter"
                />
            @endforeach
        </div>
        <div class="mt-12 flex justify-center">
            {{ $this->petsitters->links(data: ['scrollTo' => false]) }}
        </div>
    </section>
    <section
        class="relative overflow-hidden flex flex-col items-center text-center
    bg-card-green rounded-lg
    px-6 py-10 lg:px-12 lg:py-14
    mx-4 lg:mx-20 my-20
    shadow-lg border border-white/20">

        <div class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent pointer-events-none"></div>

        <h2 class="relative z-10 text-text text-2xl lg:text-4xl font-extrabold leading-tight max-w-2xl">
            {{ __('petsitter.cardTitle') }}
        </h2>

        <p class="relative z-10 mt-6 max-w-2xl text-sm lg:text-lg leading-7 text-text/90">
            {{ __('petsitter.cardSubtitle') }}
        </p>
        @if( Auth::user()?->is_petsitter)
            <h2 class="relative z-10 text-text text-2xl lg:text-4xl font-extrabold leading-tight max-w-2xl">
                {{ __('petsitter.cardTitleAlready') }}
            </h2>

            <p class="relative z-10 mt-6 max-w-2xl text-sm lg:text-lg leading-7 text-text/90">
                {{ __('petsitter.cardSubtitleAlready') }}
            </p>
            <a href="{{ route('petsitter.profile') }}" class="relative z-10 mt-8
        bg-white text-text
        text-sm lg:text-xl
        font-extrabold uppercase tracking-wide
        px-8 py-4 lg:px-12
        rounded-2xl shadow-md
        hover:-translate-y-1 hover:shadow-lg
        transition-all duration-300" title="{{ __('petsitter.goProfile') }}">
                {{ __('petsitter.already') }}
            </a>
        @else
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
        @endif


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
            src="{{ asset('svg/ill_7.webp') }}"
            alt="illustration d'une femme promenant un chien brun"
            class="hidden lg:block absolute
        bottom-0 right-0
        w-48 xl:w-64
        translate-x-3 translate-y-1
        opacity-95 pointer-events-none"
        >

    </section>
</div>

