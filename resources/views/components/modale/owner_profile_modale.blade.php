<dialog
    wire:ignore.self
    x-data="{ open: false }"
    x-on:open-datas-modal.window="
        open = true;
        $el.showModal();
    "
    x-on:update-data.window="
        open = false;
        $el.close();
    "
    x-on:close="open = false"
    x-cloak
    class="rounded-2xl p-0 backdrop:bg-black/50 w-full mx-auto mt-20 max-w-2xl shadow-xl"
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
            Modifier mes informations
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


        <form wire:submit.prevent="updateData" class="space-y-4" enctype="multipart/form-data">

            <x-forms.input-label
                wire:model="image"
                label="Image"
                name="image"
                type="file"
            />

            <x-forms.input-label
                wire:model="adress"
                label="Adresse"
                name="adress"
                type="text"
                placeholder="Entrez votre nouvelle adresse"
            />

            <x-forms.input-label
                wire:model="phone"
                label="Mon numéro de téléphone"
                name="phone"
                type="tel"
                placeholder="Entrez votre nouveau numéro de téléphone"
            />

            <x-forms.input-label
                wire:model="email"
                label="Votre nouvel email"
                name="email"
                type="email"
                placeholder="Votre nouvel email"
            />

            <div class="flex justify-end pt-4">
                <button
                    type="submit"
                    class="bg-btn-green hover:bg-green-800 text-white px-6 py-3 rounded-lg font-bold uppercase transition cursor-pointer"
                >
                    Changer mes informations
                </button>
            </div>

        </form>

    </div>

</dialog>
