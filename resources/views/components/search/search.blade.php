@props([
    'search'
])

<div class="relative flex-1">

    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-300 pointer-events-none">
        <x-svg.icons.search/>
    </div>

    <input
        type="search"
        wire:model.live.debounce.300ms="{{ $search }}"
        placeholder="{{ __('petsitter.placeholderSearch') }}"
        class="w-full
               border-2 border-stroke
               rounded-2xl
               py-4 pl-14 pr-5
               bg-card
               text-text
               shadow-sm
               placeholder:text-gray-400

               dark:bg-blue-950
               dark:border-blue-800
               dark:text-white
               dark:placeholder:text-white

               focus:outline-none
               focus:ring-2
               focus:ring-element
               dark:focus:ring-cyan-400"
    >

</div>
