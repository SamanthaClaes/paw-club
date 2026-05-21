<?php

use Carbon\Carbon;
use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="bg-card min-h-screen py-16">
    <section class="max-w-5xl mx-auto px-6">

        <div class="text-center mb-16">
            <h1 class="text-4xl lg:text-5xl font-bold text-card-blue mb-6">
                Politique de confidentialité
            </h1>

            <p class="text-text text-lg max-w-3xl mx-auto leading-relaxed">
                Cette politique de confidentialité explique comment Paw Club collecte,
                utilise et protège les données personnelles de ses utilisateurs.
            </p>

            <span class="block mt-6 text-sm text-gray-500">
                Dernière mise à jour :{{ Carbon::now()->format( ' M Y') }}
            </span>
        </div>

        <div class="flex flex-col gap-8">

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    1. Données collectées
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    Dans le cadre de son fonctionnement, Paw Club peut collecter différentes
                    informations personnelles nécessaires à l’utilisation de la plateforme.
                </p>

                <ul class="list-disc pl-6 text-text flex flex-col gap-2">
                    <li>Nom et prénom</li>
                    <li>Adresse email</li>
                    <li>Numéro de téléphone</li>
                    <li>Informations concernant les animaux</li>
                    <li>Photos de profil et des animaux</li>
                    <li>Données liées aux réservations et gardes</li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    2. Utilisation des données
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    Les données collectées sont utilisées uniquement afin de permettre
                    le bon fonctionnement de la plateforme Paw Club.
                </p>

                <ul class="list-disc pl-6 text-text flex flex-col gap-2">
                    <li>Gestion des comptes utilisateurs</li>
                    <li>Gestion des demandes de garde</li>
                    <li>Mise en relation entre propriétaires et petsitters</li>
                    <li>Amélioration de l’expérience utilisateur</li>
                    <li>Sécurisation de la plateforme</li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    3. Conservation des données
                </h2>

                <p class="text-text leading-relaxed">
                    Les données personnelles sont conservées uniquement pendant la durée
                    nécessaire au fonctionnement du service et au respect des obligations légales.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    4. Sécurité des données
                </h2>

                <p class="text-text leading-relaxed">
                    Paw Club met en place différentes mesures techniques et organisationnelles
                    afin de protéger les données personnelles contre tout accès non autorisé,
                    perte ou divulgation.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    5. Partage des données
                </h2>

                <p class="text-text leading-relaxed">
                    Les données personnelles ne sont jamais revendues à des tiers.
                    Certaines informations peuvent être partagées uniquement dans le cadre
                    du fonctionnement normal de la plateforme entre propriétaires et petsitters.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    6. Droits des utilisateurs
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    Conformément au RGPD, chaque utilisateur dispose des droits suivants :
                </p>

                <ul class="list-disc pl-6 text-text flex flex-col gap-2">
                    <li>Droit d’accès à ses données</li>
                    <li>Droit de rectification</li>
                    <li>Droit de suppression</li>
                    <li>Droit d’opposition</li>
                    <li>Droit à la limitation du traitement</li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    7. Cookies
                </h2>

                <p class="text-text leading-relaxed">
                    Paw Club peut utiliser des cookies techniques nécessaires au bon
                    fonctionnement de la plateforme ainsi que des cookies de mesure d’audience.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    8. Contact
                </h2>

                <p class="text-text leading-relaxed">
                    Pour toute question concernant cette politique de confidentialité
                    ou vos données personnelles, vous pouvez contacter Paw Club à l’adresse suivante :
                </p>

                <a
                    href="mailto:contact@pawclub.be"
                    class="inline-block mt-4 text-card-blue font-bold hover:underline"
                >
                    contact@pawclub.be
                </a>
            </div>

        </div>
    </section>
</div>
