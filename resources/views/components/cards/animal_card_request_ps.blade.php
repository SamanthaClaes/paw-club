<section class="grid grid-cols-2">
    <section class="border-4 border-stroke rounded-lg p-6 ml-25 bg-card max-w-4xl mx-auto">
    <h1 class="text-center text-3xl font-extrabold uppercase text-text mb-10">
        Balthazar chat de Nathalie
    </h1>

    <div class="grid grid-cols-3 gap-10">

        <div class="col-span-2 space-y-10">

            <div>
                <p class="font-bold text-text text-xl">
                    Type de surveillance
                </p>

                <p class="text-text italic">
                    Visite ponctuelle
                </p>
            </div>

            <div>
                <p class="font-bold text-text text-xl">
                    Dates de garde
                </p>

                <p class="text-text">
                    10/06/2026 - 17/06/2026
                </p>
            </div>

            <div>
                <p class="font-bold text-text text-xl">
                    Indications
                </p>

                <p class="text-text max-w-md">
                    Balthazar me demande peu d’attention.
                    Deux visites quotidiennes sont suffisantes
                    pour assurer son alimentation, vérifier son état général
                    et entretenir sa litière.
                </p>
            </div>

            <div>
                <p class="font-bold text-text text-xl">
                    Informations du propriétaire
                </p>

                <p class="text-text">
                    Rue des pommiers 45, 4000 Liège.
                </p>
            </div>
        </div>
        
        <div class="flex flex-col items-center">

            <img
                src="{{ asset('img/login/cat.jpg') }}"
                alt="Image de l'animal"
                class="w-full max-w-55 h-80 object-cover rounded-xl mb-4"
            >

            <div class="w-full">
                <p class="font-bold text-text text-lg mb-2">
                    Informations de l’animal
                </p>

                <p class="text-text">
                    Chat
                </p>

                <p class="text-text">
                    1 an
                </p>

                <p class="text-text">
                    Maine Coon
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
