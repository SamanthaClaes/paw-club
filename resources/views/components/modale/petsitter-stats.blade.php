@props([
    'selectedPetsitter',
    'favoritesCount',
    'acceptedRequestsCount',
    'refusedRequestsCount',
])

<dialog
    wire:ignore.self
    x-data="{ open: false }"

    x-on:open-petsitter-stats-modal.window="
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

        <h2 class="text-2xl font-extrabold text-text uppercase mb-8">
            {{ $selectedPetsitter?->first_name }}
            {{ $selectedPetsitter?->last_name }}
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <div class="border-2 border-stroke bg-card rounded-xl p-5 text-center">

                <p class="text-sm uppercase font-bold text-text">
                    Nombre d'ajout en favoris
                </p>

                <p class="text-3xl font-extrabold text-text mt-2">
                    {{ $favoritesCount }}
                </p>
            </div>

            <div class="border-2 border-stroke bg-card rounded-xl p-5 text-center">

                <p class="text-sm uppercase font-bold text-text">
                    Demandes acceptées
                </p>

                <p class="text-3xl font-extrabold text-text mt-2">
                    {{ $acceptedRequestsCount }}
                </p>
            </div>

            <div class="border-2 border-stroke bg-card rounded-xl p-5 text-center">

                <p class="text-sm uppercase font-bold text-text">
                    Demandes refusées
                </p>

                <p class="text-3xl font-extrabold text-text mt-2">
                    {{ $refusedRequestsCount }}
                </p>
            </div>

        </div>

        <div class="flex justify-end mt-8">

            <button
                type="button"
                @click="
                    open = false;
                    $el.closest('dialog').close();
                "
                class="border-2 border-gray-300 px-6 py-3 rounded-lg font-bold uppercase hover:bg-gray-100 transition cursor-pointer"
            >
                Fermer
            </button>

        </div>

    </div>

</dialog>
