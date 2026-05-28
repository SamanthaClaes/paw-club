@props([
    'name',
    'image',
    'description',
    'location',
    'tags' => [],
    'chooseUrl' => '#',
    'contactUrl' => '#',
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
            hover:shadow-lg hover:-translate-y-1
            transition-all duration-300
            overflow-hidden
            relative'
        ]) }}
    >

        <div class="relative z-10 flex flex-col lg:flex-row gap-2 lg:items-start h-full">

            <div class="shrink-0 flex justify-center">

                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($image) }}"
                    alt="{{ $name }}"
                    class="rounded-full object-cover
                    w-28 h-28 lg:w-32 lg:h-32
                    border-4 border-white/60
                    shadow-lg"
                >

            </div>

            <div class="flex-1 flex flex-col gap-5 w-full">

                <div>
                    <div class="flex items-center justify-between">
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-text mb-3 leading-tight">
                        {{ $name }}
                    </h2>
                        <p class="font-extrabold text-text mb-3 leading-tight">
                            {{ $location }}
                        </p>
                    </div>
                    <p class="text-text text-sm lg:text-base leading-7 max-w-3xl">
                        {{ $description }}
                    </p>

                </div>

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

                <div class="border-b border-gray-200 pt-1"></div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 pt-1">

                    <a
                        href="{{ $chooseUrl }}"
                        class="bg-card-orange hover:bg-hover-orange
                        hover:text-white
                        text-text font-extrabold
                        text-sm lg:text-base
                        text-center whitespace-nowrap
                        py-3 px-5
                        rounded-2xl
                        shadow-md hover:shadow-lg hover:-translate-y-1
                        transition-all duration-300"
                    >
                        Choisir {{ $name }}
                    </a>

                    <a
                        href="{{ $contactUrl }}"
                        class="bg-card-pink hover:bg-hover-pink
                        hover:text-white
                        text-text font-extrabold
                        text-sm lg:text-base
                        text-center whitespace-nowrap
                        py-3 px-5
                        rounded-2xl
                        shadow-md hover:shadow-lg hover:-translate-y-1
                        transition-all duration-300"
                    >
                        Contacter {{ $name }}
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>
