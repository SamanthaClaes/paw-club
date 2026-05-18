@props([
    'petId',
    'name',
])

<dialog
    wire:ignore.self
    x-data="{ open: false }"
    x-on:open-delete-dog-modal.window="
        open = true;
        $el.showModal();
    "
    x-on:dog-deleted.window="
        open = false;
        $el.close();
    "
    x-on:close="
        open = false;

    "
    x-cloak
    class="rounded-2xl p-0 backdrop:bg-black/50 w-full mx-auto mt-20 max-w-xl shadow-xl"
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
            Supprimer {{ $name }}
        </h2>

        <p class="text-text text-lg mb-10">
            Êtes-vous sûr de vouloir supprimer
            <span class="font-bold">{{ $name }}</span> ?
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
                wire:click="delete({{$petId}})"
                type="button"
                class="bg-red-500 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-bold uppercase transition cursor-pointer"
            >
                Oui
            </button>

        </div>

    </div>

</dialog>
