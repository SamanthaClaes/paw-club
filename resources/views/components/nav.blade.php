<nav class="bg-element p-2 text-text">
    <ul class="flex gap-8 justify-around items-center ">
        <input type="checkbox" id="menu-toggle" class="peer hidden">
        <label for="menu-toggle"
               class="md:hidden flex items-center px-3 py-2 border rounded text-text-brown cursor-pointer">
            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
        </label>
        <div class="w-full hidden peer-checked:block md:flex md:items-center md:w-auto">
            <div class="text-sm md:grow flex flex-col md:flex-row md:items-center">
                <li>
                    <a href="{{ route('daycare.index') }}" class="hover:underline">La garderie</a>
                </li>
                <li>
                    <a href="{{ route('petsitter.index') }}" class="hover:underline">Les petsitters</a>
                </li>
                <li>
                    <a href="/" class="hover:underline">Contact</a>
                </li>
                <li>
                    <a href="/" class="hover:underline">Me connecter</a>
                </li>
            </div>
        </div>
        <li>
            <a href="{{ route('home')}}">
                <x-svg.logo/>
            </a>
        </li>


    </ul>

</nav>
