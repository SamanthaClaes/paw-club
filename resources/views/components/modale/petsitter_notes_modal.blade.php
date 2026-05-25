
@props([
    'request'
])
<dialog
    wire:ignore.self
    x-data="{ open: false }"

    x-on:open-note-modal.window="
        open = true;
        $el.showModal();
    "

    x-on:close-note-modal.window="
    open = false;
    $el.close();
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

        <div class="mb-8">

            <h2 class="text-2xl font-extrabold text-text uppercase mb-4">
                Ajouter une note
            </h2>

            <p class="text-text text-lg leading-7">
                Ajoutez une note concernant le séjour de l’animal afin de garder un suivi clair des gardes effectuées.
            </p>

        </div>

        <form wire:submit="storeNote({{ $request->id }})">

            <div class="mb-6">

                <label
                    for="note"
                    class="block text-sm font-bold uppercase text-text mb-3"
                >
                    Votre note
                </label>

                <textarea
                    wire:model="note"

                    id="note"

                    rows="6"

                    placeholder="Ajoutez une note concernant le comportement, les habitudes ou le séjour de l’animal..."

                    class="w-full border-2 border-element rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-background resize-none"
                ></textarea>

                @error('note')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
                @enderror

            </div>

            <div class="flex justify-end gap-4">

                <button
                    type="button"

                    @click="
                        open = false;
                        $el.closest('dialog').close();
                    "

                    class="border-2 border-gray-300 px-6 py-3 rounded-lg font-bold uppercase hover:bg-gray-100 transition cursor-pointer"
                >
                    Annuler
                </button>

                <button
                    type="submit"
                    class="bg-card-green hover:bg-hover text-text font-bold px-6 py-3 rounded-lg uppercase transition cursor-pointer"
                >
                    Ajouter ma note
                </button>

            </div>

        </form>

    </div>

</dialog>
