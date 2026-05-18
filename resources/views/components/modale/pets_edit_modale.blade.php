
<dialog
    wire:ignore.self
    x-data="{ open: false }"
    x-on:edit-dog.window="
        open = true;
        $el.showModal();

    "
    x-on:close="open = false"
    x-on:update-dog.window=" open = false;
    $el.close()
    "

    x-cloak
    class="rounded-2xl p-0 backdrop:bg-black/50 w-full mx-auto max-w-2xl m-auto"
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
            Modifier les informations de {{ $this->name }}
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form wire:submit.prevent="updatePet" class="space-y-4" enctype="multipart/form-data">

            <x-forms.input-label
                wire:model="name"
                label="Nom de l’animal"
                name="name"
                type="text"
                placeholder="Entrez le nom de votre animal"
            />

            <x-forms.input-label
                wire:model="breed"
                label="Race"
                name="breed"
                type="text"
                placeholder="Entrez la race de votre animal"
            />

            <x-forms.input-label
                wire:model="birth_date"
                label="Date de naissance"
                name="birth_date"
                type="date"
                placeholder="L’age de votre animal"
            />
            <label  class="block text-sm text-text uppercase font-bold mb-1" for="description">Description</label>
            <textarea  wire:model="description" name="description" id="description" cols="30" rows="10" class="resize-none w-full border-2 border-element rounded-lg px-3 py-2 ">

            </textarea>

            <div class="flex justify-end pt-4">
                <button
                    type="submit"
                    class="bg-btn-green hover:bg-green-800 text-white px-6 py-3 rounded-lg font-bold uppercase transition"
                >
                    Modifier mon animal
                </button>
            </div>

        </form>

    </div>

</dialog>
