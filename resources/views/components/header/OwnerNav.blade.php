<nav class="mt-20 mb-30">
    <h1 class="sr-only">
        {{ __('petsitterNav.title') }}
    </h1>

    <ul class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        <li>
            <a
                href="{{ route('owner.history') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('owner.history') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.history') }}
            </a>
        </li>

        <li>
            <a
                href="{{ route('owner.profile') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('owner.profile') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.profile') }}
            </a>
        </li>
    </ul>
</nav>
