@props([
    'title',
    'number',
    'route',
])

<a href="{{ $route }}" class="block">

    <flux:card
        variant="soft"
        {{ $attributes->merge([
            'class' => '
                h-full
                min-h-40
                flex flex-col
                bg-card
                shadow-sm
                transition-all duration-300
                hover:scale-105
                dark:bg-blue-950
                dark:border-blue-800
                dark:shadow-xl
                dark:hover:bg-blue-900
            '
        ]) }}
    >

        <flux:text class="uppercase font-bold text-text dark:text-white min-h-12">
            {{ $title }}
        </flux:text>

        <flux:heading
            size="xl"
            class="mt-2 text-text dark:text-white"
        >
            {!! $number !!}
        </flux:heading>

        <flux:link
            href="{{ $route }}"
            variant="subtle"
            class="mt-auto pt-4 text-text hover:text-hover dark:text-zinc-300 dark:hover:text-white"
        >
            Voir les détails →
        </flux:link>

    </flux:card>

</a>
