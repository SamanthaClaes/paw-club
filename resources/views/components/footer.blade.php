<footer class="bg-element px-8 py-6">
    <nav class="grid grid-cols-5 gap-6 items-start">
        <div>
            <a href="">
                <x-svg.logo/>
            </a>
        </div>
        <ul>
            <li class="font-bold uppercase text-[16px]">
                Services
            </li>
            <li>
                <a href="{{ route('daycare.index') }}" class="hover:underline text-[12px]">Notre garderie (chien uniquement)
                </a>
            </li>
            <li>
                <a href="#" class=" text-[12px]">Réserver un PetSitter</a>
            </li>
            <li>
                <a href="">
                    Contact
                </a>
            </li>
        </ul>
        <ul>
            <li class="font-bold uppercase text-[16px]">Informations</li>
            <li>
                <a href="" class=" text-[12px]">À propos</a>
            </li>
            <li>
                <a href="" class=" text-[12px]">Conditions générales</a>
            </li>
            <li>
                <a href="" class=" text-[12px]">Politique de confidentialité</a>
            </li>
        </ul>
        <ul>
            <li class="font-bold uppercase text-[16px]">Contact</li>
            <li>
                <a href="" class=" text-[12px]">Email</a>
            </li>
            <li>
                <a href="" class=" text-[12px]">Téléphone</a>
            </li>
            <li>
                <a href="" class=" text-[12px]">Adresse de la garderie</a>
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
