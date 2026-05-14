@props([
    'animal_name',
    'name',
    'type',
    'start_date',
    'end_date',
    'description',
    'email',
    'animal_age',
    'breed',
    'image',
])

<section class="grid grid-cols-2">
    <section class="border-4 border-stroke rounded-lg p-6 ml-25 bg-card max-w-4xl mx-auto">
    <h1 class="text-center text-3xl font-extrabold uppercase text-text mb-10">
        {{ $animal_name }}, {{ $type }} de {{$name}}
    </h1>

    <div class="grid grid-cols-3 gap-10">

        <div class="col-span-2 space-y-10">

            <div>
                <p class="font-bold text-text text-xl">
                    Dates de garde
                </p>

                <p class="text-text">
                    {{ $start_date }} - {{ $end_date }}
                </p>
            </div>

            <div>
                <p class="font-bold text-text text-xl">
                    Indications
                </p>

                <p class="text-text max-w-md">
                    {{ $description }}
                </p>
            </div>

            <div>
                <p class="font-bold text-text text-xl">
                    Informations du propriétaire
                </p>

                <p class="text-text">
                    {{ $email }}
                </p>
            </div>
        </div>

        <div class="flex flex-col items-center">

            <img
                src="{{\Illuminate\Support\Facades\Storage::url($image)  }}"
                alt="Image de l'animal"
                class="w-full max-w-55 h-80 object-cover rounded-xl mb-4"
            >

            <div class="w-full">
                <p class="font-bold text-text text-lg mb-2">
                    Informations de l’animal
                </p>

                <p class="text-text">
                    {{ $type }}
                </p>

                <p class="text-text">
                    {{ $animal_age }} ans
                </p>

                <p class="text-text">
                    {{ $breed }}
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6 mt-12">
        <button
            class="bg-btn-green hover:bg-green-500 transition rounded-lg py-3 font-bold text-cta"
        >
            Accepter la demande
        </button>

        <button
            class="bg-btn-red hover:bg-red-500 transition rounded-lg py-3 font-bold text-text-red"
        >
            Refuser la demande
        </button>
    </div>
</section>
</section>
