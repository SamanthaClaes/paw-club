@props([
 'type',
 'nbr',
 'visit',
])

<section x-data="{ open: false }" class="border-4 border-stroke rounded-lg bg-card p-6 max-w-4xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-6 items-center lg:items-start">

        <div class="shrink-0">
            <img
                src="{{ asset($image ?? 'img/default-profile.jpg') }}"
                alt="Image de profile"
                class="w-44 h-44 rounded-lg object-cover">
        </div>

        <div class="flex-1 w-full">
            <h1 class="uppercase font-extrabold text-text text-2xl mb-6">
                Informations pratiques
            </h1>

            <div class="space-y-4 text-text text-lg">
                <p>
                    <span class="font-extrabold">Types d’animaux gardés :</span>
                    {{ $type }}
                </p>

                <p>
                    <span class="font-extrabold">Maximum d'animaux gardés :</span>
                    {{ $nbr }}
                </p>

                <p>
                    <span class="font-extrabold">types de visites effectuées :</span>
                    {{ $visit }}
                </p>

            </div>

            <div class="mt-8">
                <button type="button"  @click="$dispatch('open-password-modal')"
                        class="w-full bg-btn-green hover:bg-green-800 text-white font-extrabold uppercase rounded-lg py-3 transition">
                    Modifier mes informations
                </button>
            </div>
        </div>
    </div>
</section>
