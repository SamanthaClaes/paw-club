@props([
    'selectedRequest' => null,
])

<dialog
    wire:ignore.self
    x-data="{ open: false }"

    x-on:open-delete-petsitting-modal.window="
        open = true;
        document.body.classList.add('overflow-hidden');
        $el.showModal();
    "

    x-on:close-delete-petsitting-modal.window="
        open = false;
        document.body.classList.remove('overflow-hidden');
        $el.close();
    "

    x-on:close="
        open = false;
        document.body.classList.remove('overflow-hidden');
    "

    x-cloak
    class="rounded-2xl p-0 backdrop:bg-black/50 w-full mx-auto max-w-lg m-auto"
>
    <div
        x-show="open"
        x-transition
        class="bg-white rounded-2xl p-8 relative"
    >

        <button
            type="button"
            @click="
                open = false;
                document.body.classList.remove('overflow-hidden');
                $el.closest('dialog').close();
            "
            class="absolute top-4 right-4 text-3xl text-text hover:text-red-500 transition cursor-pointer"
        >
            ×
        </button>

        <h2 class="text-2xl font-extrabold text-text uppercase mb-6">
            Supprimer la garde
        </h2>

        <p class="text-text leading-relaxed">
            Êtes-vous sûr de vouloir supprimer la garde
            @if($selectedRequest?->pet)
                de <strong>{{ $selectedRequest->pet->name }}</strong>
            @endif
            ?
        </p>

        <p class="text-sm text-gray-500 mt-3">
            Cette garde sera retirée de votre planning.
        </p>

        <div class="flex justify-end gap-4 pt-8">

            <button
                type="button"
                @click="
                    open = false;
                    document.body.classList.remove('overflow-hidden');
                    $el.closest('dialog').close();
                "
                class="px-6 py-3 rounded-lg font-bold uppercase border-2 border-stroke text-text hover:bg-gray-100 transition cursor-pointer"
            >
                Non
            </button>

            <button
                type="button"
                wire:click="deleteRequest({{ $selectedRequest?->id }})"
                class="bg-btn-red hover:bg-red-600 text-text-red hover:text-white px-6 py-3 rounded-lg font-bold uppercase transition cursor-pointer"
            >
                Oui, supprimer
            </button>

        </div>

    </div>
</dialog>
