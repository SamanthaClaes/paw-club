@props([
    'animalTypes',
    'animalTypesId',
    'genders',

])

<dialog
    wire:ignore.self
    x-data="{ open: false }"
    x-on:open-pets-modal.window="
        open = true;
        $el.showModal();
    "
    x-on:close="open = false"
    x-on:pet-created.window=" open = false;
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
            Ajouter un animal
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


        <form wire:submit.prevent="storePet" class="space-y-4" enctype="multipart/form-data">

            <x-forms.input-label
                wire:model="pet_image"
                label="Photo de votre animal"
                name="pet_image"
                type="file"
            />

            <x-forms.input-label
                wire:model="name"
                label="Nom de l’animal"
                name="name"
                type="text"
                placeholder="Entrez le nom de votre animal"
            />

            <x-forms.select-option
                wire:model.live="animal_type_id"
                name="animal_type_id"
                label="Choisissez un type d’animal"
            >
                <option value="">Choisissez un type d’animal</option>

                @foreach($animalTypes as $animalType)
                    <option value="{{ $animalType->id }}">
                        {{ ucfirst($animalType->type) }}
                    </option>
                @endforeach
            </x-forms.select-option>

            <x-forms.select-option
                wire:model="gender"
                name="gender"
                label="Genre"
            >
                <option value="">Choisissez un genre</option>

                <option value="1">
                    Mâle
                </option>

                <option value="0">
                    Femelle
                </option>

            </x-forms.select-option>

            <div
                x-data="{
            search: '',
            open: false
        }"
                x-on:reset-breed-search.window="
        search = '';
    "
                @click.outside="open = false"
                class="relative"
            >

                <label class="block text-sm text-text uppercase font-bold mb-1">
                    Choisissez la race de votre animal
                </label>

                <input
                    type="text"
                    x-model="search"
                    @focus="open = true"
                    placeholder="Rechercher une race..."
                    class="w-full border-2 border-element rounded-lg px-3 py-2"
                >

                <div
                    x-show="open"
                    x-transition
                    x-cloak
                    class="absolute left-0 top-full w-full bg-white border-2 border-element rounded-lg mt-1 max-h-48 overflow-y-auto z-50 shadow-lg"
                >

                    @foreach($animalTypes as $animalType)

                        @if($animalType->id == $animalTypesId)

                            @foreach($animalType->breeds as $breed)

                                <div
                                    x-show="'{{ strtolower($breed->name) }}'
                                .includes(search.toLowerCase())"

                                    @click="
                                $wire.set('breed_id', {{ $breed->id }});
                                search = '{{ $breed->name }}';
                                open = false;
                            "

                                    class="px-3 py-2 hover:bg-gray-100 cursor-pointer"
                                >
                                    {{ $breed->name }}
                                </div>

                            @endforeach

                        @endif

                    @endforeach

                </div>

            </div>

            <x-forms.input-label
                wire:model="birth_date"
                label="Date de naissance"
                name="birth_date"
                type="date"
                placeholder="L’age de votre animal"
            />

            <label class="block text-sm text-text uppercase font-bold mb-1" for="description">
                Description
            </label>

            <textarea
                wire:model="description"
                name="description"
                id="description"
                cols="30"
                rows="10"
                class="resize-none w-full border-2 border-element rounded-lg px-3 py-2 "
            ></textarea>

            <div class="flex justify-end pt-4">
                <button
                    type="submit"
                    class="bg-btn-green hover:bg-green-800 text-white px-6 py-3 rounded-lg font-bold uppercase transition cursor-pointer"
                >
                    Ajouter mon animal
                </button>
            </div>

        </form>

    </div>

</dialog>
