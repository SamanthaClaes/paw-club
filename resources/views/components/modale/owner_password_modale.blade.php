<dialog
    wire:ignore.self
    x-data="{ open: false }"
    x-on:open-password-modal.window="
        open = true;
        $el.showModal();
    "
    x-on:password-updated.window="
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
            Modifier mon mot de passe
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


        <form wire:submit.prevent="updatePw" class="space-y-4">

            <x-forms.input-label
                wire:model="current_password"
                label="Mot de passe actuel"
                name="current_password"
                type="password"
                placeholder="Entrez votre mot de passe actuel"
            />

            <x-forms.input-label
                wire:model="password"
                label="Nouveau mot de passe"
                name="password"
                type="password"
                placeholder="Entrez votre nouveau mot de passe"
            />

            <x-forms.input-label
                wire:model="password_confirmation"
                label="Confirmer le nouveau mot de passe"
                name="password_confirmation"
                type="password"
                placeholder="Confirmez votre nouveau mot de passe"
            />

            <div class="flex justify-end pt-4">
                <button
                    type="submit"
                    class="bg-btn-green hover:bg-green-800 text-white px-6 py-3 rounded-lg font-bold uppercase transition cursor-pointer"
                >
                    Changer mon mot de passe
                </button>
            </div>

        </form>

    </div>

</dialog>
