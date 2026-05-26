<nav class="mt-20 mb-30 max-w-7xl mx-auto">
    <h1 class="sr-only">
        {{ __('petsitterNav.title') }}
    </h1>

    <ul class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        <li>
            <a
                href="{{ route('petsitter.request') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('petsitter.request') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.requests') }}
            </a>
        </li>

        <li>
            <a
                href="{{ route('petsitter.planning') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('petsitter.planning') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.planning') }}
            </a>
        </li>

        <li>
            <a
                href="{{ route('petsitter.history') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('petsitter.history') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.history') }}
            </a>
        </li>

        <li>
            <a
                href="{{ route('petsitter.profile') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('petsitter.profile') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.profile') }}
            </a>
        </li>
    </ul>
</nav>
