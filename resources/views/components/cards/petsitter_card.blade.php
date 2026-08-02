@props([
    'name',
    'last',
    'image',
    'description',
    'location',
    'price',
    'tags' => [],
    'chooseUrl' => '#',
    'contactUrl' => '#',
    'petsitter',
    'isFavorite' => false,
])

<div
    x-data="{ shown : false }"
    x-intersect.full="shown = true"
>

    <div
        x-show="shown"
        x-transition
        {{ $attributes->merge([
            'class' => '
            border-2 border-stroke
            bg-card
            rounded-3xl
            p-4 lg:p-6
            w-full
            h-full
            shadow-lg
            transition-all duration-300
            overflow-hidden
            relative'
        ]) }}
    >


        <div class="relative z-10 flex flex-col lg:flex-row gap-2 lg:items-start h-full">

            <div class="shrink-0 flex justify-center">
                <img
                    src="{{ $petsitter->getImageUrl(800) }}"
                    srcset="
        {{ $petsitter->getImageUrl(400) }} 400w,
        {{ $petsitter->getImageUrl(800) }} 800w,
        {{ $petsitter->getImageUrl(1200) }} 1200w
    "
                    sizes="(max-width: 1024px) 112px, 128px"
                    alt="{{ $petsitter->first_name }}"
                    class="rounded-full object-cover
           w-28 h-28 lg:w-32 lg:h-32
           border-4 border-white/60
           shadow-lg"
                />
            </div>


            <div class="flex-1 flex flex-col gap-5 w-full">
                <div class="flex items-start justify-between gap-4">

                    <div>
                        <h2 class="text-2xl lg:text-3xl font-extrabold text-text leading-tight">
                            {{ ucfirst($name)  }} {{ ucfirst($last) }}
                        </h2>

                        <p class="font-semibold text-text text-lg mt-1">
                            {{ $location }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                    @auth
                        @if(auth()->id() !== $petsitter->id)
                            <button
                                wire:click="toggleFavorite({{ $petsitter->id }})"
                                type="button"
                                title="{{ $isFavorite ? __('ui.remove_favorite') : __('ui.add_favorite') }}"
                                class="flex h-11 w-11 items-center justify-center rounded-full border-2 transition {{ $isFavorite ? 'border-card-pink bg-card-pink text-white' : 'border-stroke bg-white text-card-pink hover:bg-card-pink hover:text-white' }}"
                            >
                                <span class="text-xl" aria-hidden="true">{{ $isFavorite ? '♥' : '♡' }}</span>
                                <span class="sr-only">{{ $isFavorite ? __('ui.remove_favorite') : __('ui.add_favorite') }}</span>
                            </button>
                        @endif
                    @endauth
                    <div
                        class="
        bg-card-green
        text-text
        font-extrabold
        text-sm lg:text-base
        px-4 py-2
        rounded-full
        shadow-md
        whitespace-nowrap
        shrink-0
        "
                    >
                        {{ $price }} €/jour
                    </div>
                    </div>

                </div>

                <p class="text-text text-sm lg:text-base leading-7 max-w-3xl mt-4">
                    {{ $description }}
                </p>

                <div class="flex flex-wrap gap-2">

                    @foreach($tags as $tag)

                        <span
                            class="bg-gray-200/80 text-gray-700
                            px-4 py-1.5
                            rounded-2xl
                            text-xs lg:text-sm
                            font-semibold
                            backdrop-blur-sm">

                            {{ ucfirst($tag) }}

                        </span>

                    @endforeach

                </div>


                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 pt-1">

                    @if(auth()->check() && auth()->user()->pets()->exists())

                        <a
                            href="{{ $chooseUrl }}"
                            class="bg-card-orange hover:bg-hover-orange hover:text-white text-text font-extrabold text-sm lg:text-base text-center whitespace-nowrap py-3 px-5 rounded-2xl shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300"
                        >
                            {{ __('petsitter.cardChoose') }} {{ $name }}
                        </a>

                    @endif

                    <a
                        href="{{ $contactUrl }}"
                        class="bg-card-pink hover:bg-hover-pink hover:text-white text-text font-extrabold text-sm lg:text-base text-center whitespace-nowrap py-3 px-5 rounded-2xl shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300"
                    >
                        {{ __('petsitter.cardContact') }} {{ $name }}
                    </a>

                </div>
            </div>

        </div>

    </div>

</div>
