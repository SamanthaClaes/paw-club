@props([
    'animalTypesList',
    'visitTypesList',
])

<dialog
    wire:ignore.self
    x-data="{ open: false }"
    x-on:open-update-infos.window="
        open = true;
        document.documentElement.classList.add('overflow-hidden');
        document.body.classList.add('overflow-hidden');
        $el.showModal();
    "
    x-on:update-infos.window="
        open = false;
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
        $el.close();
    "
    x-on:close="
        open = false;
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
    "
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


        <form wire:submit.prevent="updateInfos" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="block text-sm text-text uppercase font-bold mb-3">
                    Types d'animaux
                </label>

                <div class="grid grid-cols-2 gap-3">
                    @foreach($animalTypesList as $animalType)
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input
                                type="checkbox"
                                wire:model="animalTypes"
                                value="{{ $animalType->id }}"
                                class="w-4 h-4 accent-btn-green"
                            >

                            <span>
                        {{ ucfirst(__( 'animalTypes.' . $animalType->type)) }}
                    </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm text-text uppercase font-bold mb-3">
                    Types de visites
                </label>

                <div class="grid grid-cols-2 gap-3">
                    @foreach($visitTypesList as $visitType)
                        <label class="flex items-center gap-3 cursor-pointer mb-3">
                            <input
                                type="checkbox"
                                wire:model="visitTypes"
                                value="{{ $visitType->id }}"
                                class="w-4 h-4 accent-btn-green"
                            >

                            <span>
                        {{ ucfirst( __( 'visitTypes.' . $visitType->name)) }}
                    </span>
                        </label>
                    @endforeach
                </div>
                <div>
                    <x-forms.select-option wire:model="price" label="{{ __('petsitterProfile.price')}}" name="price">
                        @foreach($this->prices as $price)
                            <option value="{{ $price }}">
                                {{ $price }} €
                            </option>
                        @endforeach
                    </x-forms.select-option>
                </div>
            </div>

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
