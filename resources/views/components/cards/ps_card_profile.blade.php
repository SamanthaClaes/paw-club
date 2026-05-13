@props([
 'last_name',
 'first_name',
 'email',
 'phone',
 'adress',
])

<section class="border-4 border-stroke rounded-lg bg-card p-6 max-w-4xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-6 items-center lg:items-start">

        <div class="shrink-0">
            <img
                src="{{ asset($image ?? 'img/default-profile.jpg') }}"
                alt="Image de profile"
                class="w-44 h-44 rounded-lg object-cover">
        </div>

        <div class="flex-1 w-full">
            <h1 class="uppercase font-extrabold text-text text-2xl mb-6">
                Informations personnelles
            </h1>

            <div class="space-y-4 text-text text-lg">
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
                    {{ $adress }}
                </p>
            </div>

            <div class="mt-8">
                <button
                    class="w-full bg-btn-green hover:bg-green-800 text-white font-extrabold uppercase rounded-lg py-3 transition">
                    Modifier mes informations
                </button>
            </div>
        </div>

    </div>
</section>
