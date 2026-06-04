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
            {{ __('petModal.addAnAnimal') }}
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
            {{ $slot }}
            <x-forms.input-label
                wire:model="pet_image"
                label="{{ __('petModal.animalPicture') }}"
                name="pet_image"
                type="file"
            />

            <x-forms.input-label
                wire:model="name"
                label="{{ __('petModal.animalName') }}"
                name="name"
                type="text"
                placeholder="Entrez le nom de votre animal"
            />

            <x-forms.select-option
                wire:model.live="animal_type_id"
                name="animal_type_id"
                label="{{ __('petModal.animalType') }}"
            >
                <option value="">{{ __('petModal.chooseAnimalType') }}</option>

                @foreach($animalTypes as $animalType)
                    <option value="{{ $animalType->id }}">
                        {{ ucfirst(__( 'animalTypes.' . $animalType->type)) }}
                    </option>
                @endforeach
            </x-forms.select-option>

            <x-forms.select-option
                wire:model="gender"
                name="gender"
                label="{{ __('petModal.gender') }}"
            >
                <option value="">{{ __('petModal.chooseGender') }}</option>

                <option value="1">
                    {{ __('petModal.male') }}
                </option>

                <option value="0">
                    {{ __('petModal.female') }}
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
                    {{ __('petModal.chooseBreed') }}
                </label>

                <input
                    type="text"
                    x-model="search"
                    @focus="open = true"
                    placeholder="{{ __('petModal.searchBreed') }}"
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
                                    x-show="'{{ strtolower(__('breed.' . $breed->name)) }}'
    .includes(search.toLowerCase())"

                                    @click="
                                $wire.set('breed_id', {{ $breed->id }});
                                search = '{{ __('breed.' . $breed->name) }}';
                                open = false;
                            "

                                    class="px-3 py-2 hover:bg-gray-100 cursor-pointer"
                                >
                                    {{ ucfirst(__('breed.'. $breed->name))  }}
                                </div>

                            @endforeach

                        @endif

                    @endforeach

                </div>

            </div>

            <x-forms.input-label
                wire:model="birth_date"
                label="{{ __('petModal.birthDate') }}"
                name="birth_date"
                type="date"
            />

            <x-forms.textarea-label
                name="description"
                wire:model="description"
                label=" {{ __('petModal.description') }}"
            />

            <div class="flex justify-end pt-4">
                <button
                    type="submit"
                    class="bg-btn-green hover:bg-green-800 text-white px-6 py-3 rounded-lg font-bold uppercase transition cursor-pointer"
                >
                    {{ __('petModal.addAnAnimal') }}
                </button>
            </div>

        </form>

    </div>

</dialog>
