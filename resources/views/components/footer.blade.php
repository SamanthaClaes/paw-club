<footer class="bg-element px-8 py-10">
    <nav class="grid grid-cols-5 gap-8 items-start">
        <div>
            <a href="">
                <x-svg.logo/>
            </a>
        </div>
        <ul>
            <li class="font-bold uppercase">
                Services
            </li>
            <li>
                <a href="{{ route('daycare.index') }}" class="hover:underline">Notre garderie (chien uniquement)
                </a>
            </li>
            <li>
                <a href="#">Réserver un PetSitter</a>
            </li>
            <li>
                <a href="">
                    Contact
                </a>
            </li>
        </ul>
        <ul>
            <li class="font-bold uppercase">Informations</li>
            <li>
                <a href="">À propos</a>
            </li>
            <li>
                <a href="">Fonctionnement</a>
            </li>
            <li>
                <a href="">FAQ</a>
            </li>
            <li>
                <a href="">Conditions générales</a>
            </li>
            <li>
                <a href="">Politique de confidentialité</a>
            </li>
        </ul>
        <ul>
            <li class="font-bold uppercase">Contact</li>
            <li>
                <a href="">Email</a>
            </li>
            <li>
                <a href="">Téléphone</a>
            </li>
            <li>
                <a href="">Adresse de la garderie</a>
            </li>
        </ul>
        <div class="flex gap-4 items-start">
            <div>
                <x-svg.facebook/>
            </div>
            <div >
                <x-svg.instagram/>
            </div>
        </div>
    </nav>
    <div class="mt-10 border-t pt-4 flex justify-between items-center text-sm">
        <span> © 2026 Paw Club</span>
    </div>
</footer>
