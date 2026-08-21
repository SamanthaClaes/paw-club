<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 | Paw-club</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-background text-text bg-card">

<div class="min-h-screen flex items-center justify-center px-6 py-12">

    <div class="w-full max-w-2xl text-center">
        <div class="flex justify-center mb-8">
            <img
                src="{{ asset('img/errors/404.gif') }}"
                alt="Chien indiquant l'accès refusé"
                class="w-64 h-64 object-contain"
            >
        </div>
        <p class="text-7xl md:text-9xl font-extrabold text-element leading-none">
            404
        </p>
        <h1 class="text-2xl md:text-3xl font-extrabold uppercase text-text mt-4">
            Page introuvable
        </h1>
        <p class="text-base md:text-lg text-gray-600 mt-4 max-w-lg mx-auto">
            Oups ! La page que vous recherchez n'existe pas
            ou n'est plus disponible.
        </p>
        <div class="mt-8">
            <a
                href="{{ url('/') }}"
                class="inline-block bg-btn-green hover:bg-hover-green text-cta
                       font-extrabold uppercase px-6 py-3 rounded-lg
                       transition duration-300"
            >
                Retour à l'accueil
            </a>
        </div>

    </div>

</div>

</body>
</html>
