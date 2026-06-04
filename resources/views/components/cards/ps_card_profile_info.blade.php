@props([
    'type',
    'visit',
    'animalTypesList',
    'visitTypesList',
])

<section class="border-2 border-stroke rounded-2xl bg-card p-6 h-full flex flex-col">
    <div class="flex flex-col flex-1">

        <div>
            <h1 class="uppercase font-extrabold text-text text-2xl mb-6">
                Informations pratiques
            </h1>

            <div class="space-y-4 text-text text-lg">
                <p>
                    <span class="font-extrabold">{{ __('petsitterProfile.animalType') }}</span>
                    {{ $type }}
                </p>
                <p>
                    <span class="font-extrabold">{{ __('petsitterProfile.visitType') }}</span>
                    {{ $visit }}
                </p>
            </div>
        </div>

        <div class="mt-auto pt-6">
            <button
                type="button"
                @click="$dispatch('open-update-infos')"
                class="w-full bg-btn-green hover:bg-hover-green text-cta hover:text-white font-bold uppercase rounded-xl px-4 py-3 transition cursor-pointer text-sm text-center"
            >
                {{ __('petsitterProfile.editInfos') }}
            </button>
        </div>
            <x-modale.petsitter_profileInfo_modale
                :animal-types-list="$animalTypesList"
                :visit-types-list="$visitTypesList"
            />
    </div>
</section>
