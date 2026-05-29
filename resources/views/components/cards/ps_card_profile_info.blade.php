@props([
 'type',
 'visit',
])

<section class="border-2 border-stroke rounded-2xl bg-card p-6 h-full">
    <div>

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

    </div>
</section>
