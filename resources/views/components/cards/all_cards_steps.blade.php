<div class="lg:ml-25">

    <x-cards.steps_cards
        number="1"
        :title="__('petsitter.choosePetsitter')"
        :description="__('petsitter.cardText')"
        bgColor="bg-card-orange"
        textColor="text-text"
        backgroundPattern="bg-[url(/public/svg/paws_icons.svg)] bg-repeat bg-center"
    />

</div>

<div class="lg:mr-25">

    <x-cards.steps_cards
        number="2"
        :title="__('petsitter.meetPetsitter')"
        :description="__('petsitter.cardTextTwo')"
        bgColor="bg-card-pink"
        textColor="text-text-pink"
        backgroundPattern="bg-[url(/public/svg/paws_icons_rose.svg)] bg-repeat bg-center"
    />

</div>

<div class="lg:ml-25">

    <x-cards.steps_cards
        number="3"
        :title="__('petsitter.petsitting')"
        :description="__('petsitter.cardTextThree')"
        bgColor="bg-element"
        textColor="text-text"
        backgroundPattern="bg-[url(/public/svg/paws_icon_blue.svg)] bg-repeat bg-center"
    />

</div>

<div class="lg:mr-25">

    <x-cards.steps_cards
        number="4"
        :title="__('petsitter.paid')"
        :description="__('petsitter.cardTextFour')"
        bgColor="bg-card-green"
        textColor="text-cta"
        backgroundPattern="bg-[url(/public/svg/paws_icon_green.svg)] bg-repeat bg-center"
    />

</div>

