@props([
    'selectedPetsitter'
])

<dialog
    wire:ignore.self
    x-data="{ open: false }"

    x-on:open-petsitter-status-modal.window="
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
            Modifier le statut
        </h2>

        <p class="text-text text-lg mb-8">
            Êtes-vous sûr de vouloir passer le statut de :
            <span class="font-bold">
                {{ $selectedPetsitter?->first_name }}
                {{ $selectedPetsitter?->last_name }}
            </span>

            en

            <span class="font-bold">
                {{ $selectedPetsitter?->petsitter_active === \App\Enums\PetsitterActive::ACTIVE
                    ? 'inactif'
                    : 'actif' }}
            </span>
            ?
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
                Non
            </button>

            <button
                type="button"
                wire:click="changePetsitterStatus({{ $selectedPetsitter?->id }})"
                @click="
                    open = false;
                    $el.closest('dialog').close();
                "
                class="bg-btn-green hover:bg-hover-green text-cta px-6 py-3 rounded-lg font-bold uppercase transition cursor-pointer"
            >
                Oui
            </button>

        </div>

    </div>

</dialog>
