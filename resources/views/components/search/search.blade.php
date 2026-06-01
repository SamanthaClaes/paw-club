<div class="relative flex-1">

    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">

        <x-svg.icons.search/>

    </div>

    <input
        type="search"
        wire:model.live.debounce.300ms="search"
        placeholder="Cherchez un petsitter"
        class="w-full
                border-2 border-stroke
                rounded-2xl
                py-4 pl-14 pr-5
                bg-card
                shadow-sm
                focus:outline-none focus:ring-2 focus:ring-element"
    >

</div>
