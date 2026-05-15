@props([
 'last_name',
 'first_name',
 'email',
 'phone',
 'adress',
 'zip',
 'location',
 'image',
])

<section class="border-4 border-stroke rounded-lg bg-card p-6 max-w-4xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-6 items-center lg:items-start">

        <div class="shrink-0">
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($image)  }}"
                alt="Image de profile"
                class=" w-44 h-full rounded-lg object-cover">
        </div>

        <div class="flex-1 w-full">
            <h1 class="uppercase font-extrabold text-text text-2xl mb-6">
                Informations personnelles
            </h1>

            <div class=" grid- grid-cols-2 text-text text-lg">
                <p>
                    <span class="font-extrabold">Nom & Prénom :</span>
                    {{ $last_name }} {{ $first_name }}
                </p>

                <p>
                    <span class="font-extrabold">Email :</span>
                    {{ $email }}
                </p>

                <p>
                    <span class="font-extrabold">Téléphone :</span>
                    {{ $phone }}
                </p>

                <p>
                    <span class="font-extrabold">Adresse :</span>
                    {{ $adress }} {{ $zip }} {{ $location }}
                </p>
            </div>

            <div class="mt-8">
                <button
                    type="button"
                    @click="$dispatch('open-password-modal')"
                    class="w-full bg-btn-green hover:bg-green-800 text-white font-extrabold uppercase rounded-lg py-3 transition"
                >
                    Modifier mes informations
                </button>
            </div>
        </div>

    </div>

    <dialog
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
                        class="bg-btn-green hover:bg-green-800 text-white px-6 py-3 rounded-lg font-bold uppercase transition"
                    >
                        Changer mon mot de passe
                    </button>
                </div>

            </form>

        </div>

    </dialog>
</section>
