<footer class="bg-element px-8 py-6">
    <nav class="grid grid-cols-5 gap-6 items-start">
        <div>
            <a href="">
                <x-svg.logo/>
            </a>
        </div>
        <ul>
            <li class="font-bold uppercase text-sm">
                Services
            </li>
            <li>
                <a href="{{ route('daycare.index') }}" class="hover:underline text-xs">Notre garderie (chien uniquement)
                </a>
            </li>
            <li>
                <a href="#" class=" text-xs">Réserver un PetSitter</a>
            </li>
            <li>
                <a href="" class="text-xs">
                    Contact
                </a>
            </li>
        </ul>
        <ul>
            <li class="font-bold uppercase text-sm">Informations</li>
            <li>
                <a href="" class=" text-xs">À propos</a>
            </li>
            <li>
                <a href="" class=" text-xs">Conditions générales</a>
            </li>
            <li>
                <a href="" class=" text-xs">Politique de confidentialité</a>
            </li>
        </ul>
        <ul>
            <li class="font-bold uppercase text-[16px]">Contact</li>
            <li>
                <a href="" class=" text-xs">Email</a>
            </li>
            <li>
                <a href="" class=" text-xs">Téléphone</a>
            </li>
            <li>
                <a href="" class=" text-xs">Adresse de la garderie</a>
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
    <div class="mt-6 border-t pt-4 flex justify-between items-center text-sm">
        <span> © 2026 Paw Club</span>
    </div>
</footer>
