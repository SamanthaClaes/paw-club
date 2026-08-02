<nav class="mt-20">
    <h1 class="sr-only">
        {{ __('petsitterNav.title') }}
    </h1>

    <ul class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-20">
        @if( !Auth::user()->is_petsitter)
        <li>
            <a
                href="{{ route('user.request') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('user.request') ? 'bg-stroke text-white font-bold' : '' }}"
            >
               Mes demandes
            </a>
        </li>
        @endif
        <li>
            <a
                href="{{ route('user.history') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('user.history') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.history') }}
            </a>
        </li>

        <li>
            <a
                href="{{ route('profile') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition
                {{ request()->routeIs('profile') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.profile') }}
            </a>
        </li>
        @if( Auth::user()->is_petsitter)
        <li>
            <a
                href="{{ route('petsitter.request') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition text-text
                {{ request()->routeIs('petsitter.request') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.requests') }}
            </a>
        </li>

        <li>
            <a
                href="{{ route('petsitter.planning') }}"
                class="block text-center border-2 border-stroke py-2 rounded-lg transition text-text
                {{ request()->routeIs('petsitter.planning') ? 'bg-stroke text-white font-bold' : '' }}"
            >
                {{ __('petsitterNav.planning') }}
            </a>
        </li>
        @endif
    </ul>
</nav>
