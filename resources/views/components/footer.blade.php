<footer class="bg-element px-6 py-8 ">
    <nav class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 items-start">
        <h1 class="sr-only">{{ __('footer.title') }}</h1>
        <div class="sm:col-span-2 lg:col-span-1 justify-items-center">
            <a
                href="{{ route('home') }}"
                aria-label="Retour à l'accueil de Paw Club"
            >
                <x-svg.logo/>
            </a>
        </div>
        <ul class="space-y-2">
            <li class="font-bold uppercase text-sm">{{ __('footer.services') }}</li>
            <li>
                <a href="{{ route('daycare.index') }}" class="hover:underline text-xs">
                    {{ __('footer.daycare') }}
                </a>
            </li>
            <li>
                <a href="{{ route('petsitter.index') }}#petsitters_list" class="text-xs hover:underline">{{ __('footer.petsitter') }}</a>
            </li>
            <li>
                <a href="/#contact" class="text-xs hover:underline">{{ __('footer.contact') }}</a>
            </li>
        </ul>
        <ul class="space-y-2">
            <li class="font-bold uppercase text-sm">{{ __('footer.information') }}</li>
            <li><a href="/#about" class="text-xs hover:underline">{{ __('footer.about') }}</a></li>
            <li><a href="{{ route('terms') }}" class="text-xs hover:underline">{{ __('footer.terms') }}</a></li>
            <li><a href="{{ route('confidentiality') }}" class="text-xs hover:underline">{{ __('footer.confidentiality') }}</a></li>
        </ul>
        <ul class="space-y-2">
            <li class="font-bold uppercase text-sm">{{ __('footer.contactTitle') }}</li>
            <li><a href="mailto:contact@pawclub.be " class="text-xs hover:underline">contact@pawclub.be </a></li>
            <li><a href="tel:0490909090" class="text-xs hover:underline">0490909090</a></li>
            <li><p class="text-xs">{{ __('footer.address') }}</p></li>
        </ul>
        <div class="flex gap-4 items-center lg:items-start">
            <div><x-svg.icons.facebook/></div>
            <div> <x-svg.icons.instagram/></div>
        </div>
    </nav>
    <div class="mt-8 border-t pt-4 flex flex-col sm:flex-row justify-between items-center gap-2 text-sm">
        <span>{{ __('footer.copyright') }}</span>
    </div>
</footer>
