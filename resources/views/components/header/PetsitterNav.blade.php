<nav class="mt-20 mb-30">
    <h1 class="sr-only">Navigation secondaire pour les petsitters</h1>
    <ul class="flex gap-8 justify-center">
        <li class="border-2 border-stroke py-2 px-18 rounded-lg  {{ request()->routeIs('petsitter.request') ? 'bg-stroke text-white font-bold' : '' }}">
            <a href="{{ route('petsitter.request') }}">Mes demandes</a>
        </li>
        <li class="border-2 border-stroke py-2 px-18 rounded-lg   {{ request()->routeIs('petsitter.planning') ? 'bg-stroke text-white font-bold' : '' }}">
            <a href="">Mon planning</a>
        </li>
        <li class="border-2 border-stroke py-2 px-18 rounded-lg   {{ request()->routeIs('petsitter.history') ? 'bg-stroke text-white font-bold' : '' }}">
            <a href="">Historique</a>
        </li>
        <li class="border-2 border-stroke py-2 px-18 rounded-lg   {{ request()->routeIs('petsitter.profile') ? 'bg-stroke text-white font-bold' : '' }}">
            <a href="{{ route('petsitter.profile') }}">Mon profil</a>
        </li>
    </ul>
</nav>
