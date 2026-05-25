<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.20/index.global.min.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.3.2/css/flag-icons.min.css"/>
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>
<h1 class="sr-only">Pages principales</h1>
<header>
    <x-header.nav/>
</header>
<main>
    {{ $slot }}
</main>

@livewireScripts
<x-footer/>
</body>

</html>

