<li x-data="{ open: false }" class="relative">

    <button
        type="button"
        @click="open = !open"
        class="flex items-center gap-2 hover:bg-card px-4 py-2 rounded-full transition-all duration-300 ease-in-out cursor-pointer"
    >
        <span class="fi fi-{{ app()->getLocale() === 'fr' ? 'fr' : 'gb' }}"></span>

        <svg
            class="w-4 h-4"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7"
            />
        </svg>
    </button>

    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute right-0 mt-2 bg-element rounded-lg shadow-lg overflow-hidden z-50"
    >

        <a
            href="{{ route('language.switch', 'fr') }}"
            class="flex items-center gap-2 px-4 py-3 hover:bg-card transition"
        >
            <span class="fi fi-fr"></span>
            FR
        </a>

        <a
            href="{{ route('language.switch', 'en') }}"
            class="flex items-center gap-2 px-4 py-3 hover:bg-card transition"
        >
            <span class="fi fi-gb"></span>
            EN
        </a>

    </div>

</li>
