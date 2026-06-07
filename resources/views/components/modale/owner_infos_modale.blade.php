@props([
    'selectedOwner'
])

<dialog
    wire:ignore.self
    x-data="{ open: false }"

    x-on:open-owner-modal.window="
        open = true;
        document.documentElement.classList.add('overflow-hidden');
        document.body.classList.add('overflow-hidden');
        $el.showModal();
    "

    x-on:close="
        open = false;
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
    "

    x-cloak
    class="rounded-2xl
    backdrop:bg-black/50
    w-full
    max-w-2xl
    shadow-xl
    fixed
    top-1/2
    left-1/2
    -translate-x-1/2
    -translate-y-1/2
    m-0"
>

    <div
        x-show="open"
        x-transition
        @click.outside="
            open = false;
            $el.closest('dialog').close();
        "
        class="bg-white rounded-2xl p-8 relative"
    >

        <button
            type="button"
            @click="
                open = false;
                $el.closest('dialog').close();
            "
            class="absolute top-4 right-4 text-3xl text-text hover:text-red-500 transition cursor-pointer"
        >
            ×
        </button>

        <h2 class="text-2xl font-extrabold text-text uppercase mb-6">
            {{ __('ownerModale.title') }}
        </h2>
        <p class="text-text text-lg mb-10">
            {{ __('ownerModale.firstName') }} :
            <span class="text-text font-bold">{{ $selectedOwner?->first_name }}</span>
        </p>
        <p class="text-text text-lg mb-10">
            {{ __('ownerModale.lastName') }} :
            <span class="text-text font-bold"> {{ $selectedOwner?->last_name }}</span>
        </p>
        <p class="text-text text-lg mb-10">
            {{ __('ownerModale.email') }} :
            <a href="mailto:{{ $selectedOwner?->email }}" class="font-bold underline">{{ $selectedOwner?->email }}</a>
        </p>
        <p class="text-text text-lg mb-10">
            {{ __('ownerModale.phone') }} :
            <a href="tel:{{ $selectedOwner?->phone }}" class="font-bold underline">{{ $selectedOwner?->phone }}</a>
        </p>

        <div class="flex justify-end gap-4">

            <button
                type="button"
                @click="
                    open = false;

                    $el.closest('dialog').close();
                "
                class="border-2 border-gray-300 px-6 py-3 rounded-lg font-bold uppercase hover:bg-gray-100 transition cursor-pointer"
            >
                {{ __('ownerModale.close') }}
            </button>

        </div>

    </div>

</dialog>
