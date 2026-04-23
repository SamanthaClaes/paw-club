<footer class="bg-element">
    <nav class="flex gap-8 justify-center p-8">
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
        <ul class="flex gap-4">
            <li>
                <a href="">
                   <x-svg.facebook/>
                </a>
            </li>
            <li>
                <a href="">
                    <x-svg.instagram/>
                </a>
            </li>
        </ul>
        <span class="font-bold"> 2026 Paw Club</span>
    </nav>
</footer>
