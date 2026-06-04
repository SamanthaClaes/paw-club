<div class="max-w-7xl mx-auto">
    <div class="grid lg:grid-cols-2 gap-4 items-stretch auto-rows-fr">

        <x-cards.daycare_pricing_cards
            title="{{ __('daycare.cardPinkTitle') }}"
            price="{{ __('daycare.cardPinkPrice') }}"
            border-color="border-card-pink"
        >
            {{ __('daycare.cardPinkDescription') }}
        </x-cards.daycare_pricing_cards>
        <x-cards.daycare_pricing_cards
            title="{{ __('daycare.cardOrangeTitle') }}"
            price="{{ __('daycare.cardOrangePrice') }}"
            border-color="border-card-orange"
        >
            {{ __('daycare.cardOrangeDescription') }}
        </x-cards.daycare_pricing_cards>
        <x-cards.daycare_pricing_cards
            title="{{ __('daycare.cardBlueTitle') }}"
            price="{{ __('daycare.cardBluePrice') }}"
            border-color="border-card-blue"
        >
            {{ __('daycare.cardBlueDescription') }}
        </x-cards.daycare_pricing_cards>
        <x-cards.daycare_pricing_cards
            title="{{ __('daycare.cardGreenTitle') }}"
            price="{{ __('daycare.cardGreenPrice') }}"
            border-color="border-card-green"
        >
            {{ __('daycare.cardGreenDescription') }}
        </x-cards.daycare_pricing_cards>
    </div>
</div>
