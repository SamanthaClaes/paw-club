@php
    use Carbon\Carbon;
@endphp

@props([
    'name',
    'breed',
    'birthDate',
    'description',
    'petImage',
    'petId',
])

<section class="border-5 border-stroke rounded-md overflow-hidden bg-card max-w-xl w-full mt-6">

    <div class="flex flex-row h-full">

        <div class="w-1/3">
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($petImage) }}"
                alt="photo de mon animal"
                class="w-full h-full object-cover"
            >
        </div>

        <div class="w-2/3 p-6 flex flex-col justify-between">

            <div>

                <h1 class="uppercase font-extrabold text-[#2D1B46] text-xl mb-6">
                    Informations de l’animal
                </h1>

                <div class="space-y-4 text-[#2D1B46]">

                    <p>
                        <span class="font-extrabold">Nom :</span>
                        {{ $name }}
                    </p>

                    <p>
                        <span class="font-extrabold">Race :</span>
                        {{ $breed }}
                    </p>

                    <p>
                        <span class="font-extrabold">Âge :</span>
                        {{ $birthDate }}
                    </p>

                    <p class="leading-snug">
                        <span class="font-extrabold">Besoins spécifiques :</span>
                        {{ $description }}
                    </p>

                </div>

            </div>
            <button
                wire:click="editPet({{ $petId }})"
                class="bg-btn-green hover:bg-[#7DA27D] text-[#1F3B1F] font-extrabold uppercase px-6 py-3 rounded-md transition w-full cursor-pointer mt-6"
            >
                Modifier les informations
            </button>
            <button

                @click="$dispatch('open-delete-dog-modal')"
                class="bg-btn-red hover:bg-red-700 text-red-950 hover:text-white font-extrabold uppercase px-6 py-3 rounded-md transition w-full cursor-pointer mt-6"
            >
                Supprimer le chien
            </button>

        </div>

    </div>

</section>
