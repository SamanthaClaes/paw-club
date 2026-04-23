<nav class="bg-element p-2 text-text">
    <ul class="flex gap-8 justify-around items-center ">
        <li>
            <a href="{{ route('home')}}">
                <x-svg.logo/>
            </a>
        </li>
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
    </ul>
</nav>
