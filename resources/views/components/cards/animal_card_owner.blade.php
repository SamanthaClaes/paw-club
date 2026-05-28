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
    'gender',
])

<section class="border-5 border-stroke rounded-md overflow-hidden bg-card w-full mt-6 lg:max-w-2xl ml-25">

    <div class="flex flex-col sm:flex-row h-full">

        <div class="w-full h-64 sm:h-auto sm:w-1/3">
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($petImage) }}"
                alt="photo de mon animal"
                class="w-full h-full object-cover"
            >
        </div>

        <div class="w-full sm:w-2/3 p-4 sm:p-6 flex flex-col justify-between">

            <div>

                <h1 class="uppercase font-extrabold text-text text-lg sm:text-xl mb-4 sm:mb-6">
                    Informations de l’animal
                </h1>

                <div class="space-y-3 sm:space-y-4 text-text text-sm sm:text-base">

                    <p>
                        <span class="font-extrabold">Nom :</span>
                        {{ $name }}
                    </p>

                    <p>
                        <span class="font-extrabold">Race :</span>
                        {{ $breed }}
                    </p>
                    <p>
                        <span class="font-extrabold">Genre :</span>
                        {{ $gender ? 'Mâle' : 'Femelle' }}
                    </p>

                    <p>
                        <span class="font-extrabold">Âge :</span>
                        {{ $birthDate }}
                    </p>

                    <p class="leading-relaxed">
                        <span class="font-extrabold">Besoins spécifiques :</span>
                        {{ $description }}
                    </p>

                </div>

            </div>

            <div class="flex flex-col gap-4 mt-6">

                <button
                    @click="$dispatch('edit-pet', { petId: {{ $petId }} })"
                    class="bg-btn-green hover:bg-hover text-cta font-extrabold uppercase px-4 sm:px-6 py-3 rounded-md transition w-full cursor-pointer"
                >
                    Modifier les informations
                </button>

                <button
                    @click="$dispatch('open-delete-dog-modal')"
                    class="bg-btn-red hover:bg-red-700 text-red-950 hover:text-white font-extrabold uppercase px-4 sm:px-6 py-3 rounded-md transition w-full cursor-pointer"
                >
                    Supprimer la fiche
                </button>

            </div>

        </div>

    </div>

</section>
