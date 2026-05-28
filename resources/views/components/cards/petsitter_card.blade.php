@props([
    'name',
    'image',
    'description',
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
            p-5 lg:p-8
            max-w-4xl mx-auto mb-8
            shadow-lg
            hover:shadow-2xl hover:-translate-y-1
            transition-all duration-300
            overflow-hidden
            relative'
        ]) }}
    >

        <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row gap-8 items-center lg:items-start">

            <div class="shrink-0 flex justify-center">

                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($image) }}"
                    alt="{{ $name }}"
                    class="rounded-full object-cover
                w-32 h-32 lg:w-40 lg:h-40
                border-4 border-white/60
                shadow-lg"
                >

            </div>

            <div class="flex-1 flex flex-col gap-6 w-full">

                <div>

                    <h2 class="text-2xl lg:text-4xl font-extrabold text-text mb-4 leading-tight">
                        {{ $name }}
                    </h2>

                    <p class="text-text text-base lg:text-lg leading-8 max-w-4xl">
                        {{ $description }}
                    </p>

                </div>

                <div class="flex flex-wrap gap-3">

                    @foreach($tags as $tag)

                        <span
                            class="bg-gray-200/80 text-gray-700
                        px-5 py-2
                        rounded-2xl
                        text-sm lg:text-base
                        font-semibold
                        backdrop-blur-sm">

                        {{ $tag }}

                    </span>

                    @endforeach

                </div>

                <div class="border-b border-gray-200 pt-2"></div>

                <div class="flex flex-col lg:flex-row gap-4 pt-2">

                    <a
                        href="{{ $chooseUrl }}"
                        class="bg-card-orange hover:bg-hover-orange
                    text-text font-extrabold
                    text-base lg:text-xl
                    text-center
                    py-4 px-6
                    rounded-2xl
                    flex-1
                    shadow-md hover:shadow-xl hover:-translate-y-1
                    transition-all duration-300"
                    >
                        Choisir {{ $name }}
                    </a>

                    <a
                        href="{{ $contactUrl }}"
                        class="bg-card-pink hover:bg-hover-pink
                    text-text font-extrabold
                    text-base lg:text-xl
                    text-center
                    py-4 px-6
                    rounded-2xl
                    flex-1
                    shadow-md hover:shadow-xl hover:-translate-y-1
                    transition-all duration-300"
                    >
                        Contacter {{ $name }}
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>
