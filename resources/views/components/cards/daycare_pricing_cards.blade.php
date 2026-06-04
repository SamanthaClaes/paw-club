@props([
    'title',
    'price',
    'borderColor',
])

<div
    class="flex flex-col justify-center items-center
           bg-white rounded-3xl
           min-h-72 lg:min-h-80
           px-6 py-8
           border-4 {{ $borderColor }}
          shadow-lg border
        transition-all duration-300 hover:-translate-y-2 hover:shadow-lg hover:brightness-105"
>
    <h3 class="text-lg lg:text-xl font-bold text-text text-center">
        {{ $title }}
    </h3>

    <p class="mt-6 mb-6 text-4xl lg:text-5xl font-extrabold text-text">
        {{ $price }}
    </p>

    <p class="mt-6 text-center text-sm lg:text-base text-gray-600">
        {{ $slot }}
    </p>


</div>
