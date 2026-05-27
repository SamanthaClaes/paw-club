@props([
 'type',
 'visit',
])

<section class="border-2 border-stroke rounded-lg bg-card p-6 h-full">
    <div>

        <div>
            <h1 class="uppercase font-extrabold text-text text-2xl mb-6">
                Informations pratiques
            </h1>

            <div class="space-y-4 text-text text-lg">
                <p>
                    <span class="font-extrabold">Types d’animaux gardés :</span>
                    {{ $type }}
                </p>
                <p>
                    <span class="font-extrabold">Types de visites effectuées :</span>
                    {{ $visit }}
                </p>
            </div>
        </div>

    </div>
</section>
