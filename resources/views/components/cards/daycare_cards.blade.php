@props([
    'bg',
    'textColor',
])

<div
    {{ $attributes->merge([
        'class' => "group flex flex-col justify-center items-center
        {$bg} rounded-3xl
        min-h-72 lg:min-h-80
        px-6
        shadow-lg border border-white/20
        transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:brightness-105"
    ]) }}
>

    <div class="mt-6 lg:mb-5 transition-transform duration-300 group-hover:scale-110">
        {{ $icon }}
    </div>

    <div>
        <p class="text-center text-sm leading-8 lg:text-xl lg:leading-10 pb-8 lg:pb-12 px-4 font-medium {{ $textColor }}">
            {{ $slot }}
        </p>
    </div>

</div>
