<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="dark:bg-gray-700 bg-element">
<main>
    <h1 class="sr-only">Page de connexion</h1>
    @yield( 'content')
</main>
@livewireScripts
</body>
</html>
