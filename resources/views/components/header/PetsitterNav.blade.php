<nav class="mt-20 mb-30">
    <h1 class="sr-only"> {{ __('petsitterNav.title') }}</h1>
    <ul class="flex gap-8 justify-center">
        <li class="border-2 border-stroke py-2 px-18 rounded-lg cursor-pointer {{ request()->routeIs('petsitter.request') ? 'bg-stroke text-white font-bold' : '' }}">
            <a href="{{ route('petsitter.request') }}">
                {{ __('petsitterNav.requests') }}
            </a>
        </li>
        <li class="border-2 border-stroke py-2 px-18 rounded-lg  cursor-pointer {{ request()->routeIs('petsitter.planning') ? 'bg-stroke text-white font-bold' : '' }}">
            <a href="{{ route('petsitter.planning') }}">
                {{ __('petsitterNav.planning') }}
            </a>
        </li>
        <li class="border-2 border-stroke py-2 px-18 rounded-lg cursor-pointer  {{ request()->routeIs('petsitter.history') ? 'bg-stroke text-white font-bold' : '' }}">
            <a href="">
                {{ __('petsitterNav.history') }}
            </a>
        </li>
        <li class="border-2 border-stroke py-2 px-18 rounded-lg cursor-pointer   {{ request()->routeIs('petsitter.profile') ? 'bg-stroke text-white font-bold' : '' }}">
            <a href="{{ route('petsitter.profile') }}">
                {{__('petsitterNav.profile')}}
            </a>
        </li>
    </ul>
</nav>
