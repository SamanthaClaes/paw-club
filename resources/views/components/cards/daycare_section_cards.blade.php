<div class="grid lg:grid-cols-2 gap-4 items-stretch auto-rows-fr">

    <x-cards.daycare_cards
        bg="bg-card-pink"
        text-color="text-text-pink"
    >
        <x-slot:icon>
            <x-svg.icons.icons1 />
        </x-slot:icon>
        {{ __('daycare.green') }}
    </x-cards.daycare_cards>
    <x-cards.daycare_cards    bg="bg-card-orange"
                              text-color="text-text">
        <x-slot:icon>
            <x-svg.icons.bell />
        </x-slot:icon>

        {{ __('daycare.food') }}

    </x-cards.daycare_cards>
    <x-cards.daycare_cards
        bg="bg-card-blue"
        text-color="text-text"
    >
        <x-slot:icon>
            <x-svg.icons.health />
        </x-slot:icon>

        {{ __('daycare.dogs') }}
    </x-cards.daycare_cards>

    <x-cards.daycare_cards
        bg="bg-card-green"
        text-color="text-cta"
    >
        <x-slot:icon>
            <x-svg.icons.home />
        </x-slot:icon>

        {{ __('daycare.health') }}
    </x-cards.daycare_cards>
</div>
