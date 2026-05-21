<footer class="bg-element px-6 py-8">
    <nav class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 items-start">
        <h1 class="sr-only">Navigation de fin de page</h1>
        <div class="sm:col-span-2 lg:col-span-1 justify-items-center">
            <a href="{{ route('home') }}">
                <x-svg.logo/>
            </a>
        </div>
        <ul class="space-y-2">
            <li class="font-bold uppercase text-sm">Services</li>
            <li>
                <a href="{{ route('daycare.index') }}" class="hover:underline text-xs">
                    Notre garderie (chien uniquement)
                </a>
            </li>
            <li>
                <a href="#" class="text-xs">Réserver un PetSitter</a>
            </li>
            <li>
                <a href="" class="text-xs">Contact</a>
            </li>
        </ul>
        <ul class="space-y-2">
            <li class="font-bold uppercase text-sm">Informations</li>
            <li><a href="" class="text-xs">À propos</a></li>
            <li><a href="{{ route('terms') }}" class="text-xs">Conditions générales</a></li>
            <li><a href="" class="text-xs">Politique de confidentialité</a></li>
        </ul>
        <ul class="space-y-2">
            <li class="font-bold uppercase text-sm">Contact</li>
            <li><a href="" class="text-xs">Email</a></li>
            <li><a href="" class="text-xs">Téléphone</a></li>
            <li><a href="" class="text-xs">Adresse de la garderie</a></li>
        </ul>
        <div class="flex gap-4 items-center lg:items-start">
            <div><x-svg.icons.facebook/></div>
            <div> <x-svg.icons.instagram/></div>
        </div>
    </nav>
    <div class="mt-8 border-t pt-4 flex flex-col sm:flex-row justify-between items-center gap-2 text-sm">
        <span>© 2026 Paw Club</span>
    </div>
</footer>
