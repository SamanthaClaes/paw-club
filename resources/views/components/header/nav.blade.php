@php use App\enum\UserRole; @endphp
<nav class="bg-element p-2 text-text relative z-9999">
    <input type="checkbox" id="menu-toggle" class="peer hidden">

    <div class="flex items-center justify-between">
        <label for="menu-toggle"
               class="md:hidden flex items-center px-3 py-2 border rounded cursor-pointer">
            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
        </label>
    </div>

    <div
        class="absolute top-full left-0 w-1/2 bg-element hidden peer-checked:block md:static md:block md:w-auto transition-all duration-300">
        <ul class="flex flex-col md:flex-row md:items-center gap-8 justify-around text-sm font-bold uppercase">
            <li>
                <a href="{{ route('home') }}">
                    <x-svg.logo/>
                </a>
            </li>
            <li>
                <a href="{{ route('daycare.index') }}" class="hover:bg-card px-8 py-4 w-full rounded-full cursor-pointer transition-all duration-300 ease-in-out">La garderie</a>
            </li>
            <li>
                <a href="{{ route('petsitter.index') }}" class="hover:bg-card px-8 py-4 rounded-full w-full cursor-pointer transition-all duration-300 ease-in-out">Les petsitters</a>
            </li>
            <li>
                <a href="/#contact" class="hover:bg-card px-8 py-4 rounded-full w-full cursor-pointer">Contact</a>
            </li>
            @auth
                    @if( auth()->user()->role === UserRole::OWNER)
                <li>
                        <a href="{{ route('owner.profile') }}" class="hover:bg-card px-8 py-4 rounded-full w-full cursor-pointer transition-all duration-300 ease-in-out">Mon espace</a>
                </li>
                    @endif
                    @if( auth()->user()->role === UserRole::PETSITTER)
                <li>
                        <a href="{{ route( 'petsitter.request' ) }}" class="hover:bg-card px-8 py-4rounded-full w-full cursor-pointer transition-all duration-300 ease-in-out hover:shadow-sm">Mon espace</a>
                </li>
                    @endif
                @if( auth()->user()->role === UserRole::ADMIN)
                    <li>
                        <a href="" class="hover:bg-card px-8 py-4 rounded-full w-full cursor-pointer transition-all duration-300 ease-in-out">dashboard</a>
                    </li>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-text uppercase hover:bg-card px-8 py-4 rounded-full w-full cursor-pointer transition-all duration-300 ease-in-out">
                        Me déconnecter
                    </button>
                </form>
            @endauth
            @guest
                <li>
                    <a href="{{ route('login') }}" class="hover:bg-white cursor-pointer transition-all duration-300 ease-in-out">Me connecter</a>
                </li>
            @endguest

        </ul>
    </div>
</nav>
