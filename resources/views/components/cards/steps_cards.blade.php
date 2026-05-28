@props([
    'number',
    'title',
    'description',
    'bgColor',
    'textColor',
    'backgroundPattern',
])

<div
    class="group flex items-center gap-5
    {{ $bgColor }}
    rounded-3xl
    p-6 lg:p-8
    h-full relative overflow-hidden
    min-h-44 lg:min-h-56
    {{ $backgroundPattern }}
    shadow-lg border border-white/20
    transition-all duration-300
    hover:-translate-y-2 hover:shadow-2xl hover:brightness-105">

    <div class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent pointer-events-none"></div>

    <span
        class="relative z-10 text-7xl lg:text-8xl font-black {{ $textColor }} leading-none shrink-0
        [text-shadow:0_4px_10px_rgba(0,0,0,0.20)]
        group-hover:scale-110 transition-transform duration-300">

        {{ $number }}

    </span>

    <div class="relative z-10">

        <p class="{{ $textColor }} font-extrabold text-lg lg:text-2xl mb-2">
            {{ $title }}
        </p>

        <p class="{{ $textColor }} text-sm lg:text-base font-medium leading-7">
            {{ $description }}
        </p>

    </div>

</div>
