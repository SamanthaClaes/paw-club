<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<h1 class="sr-only">Pages principales de l’admin</h1>
<header>
    <x-header.sideBar/>
</header>
<body class="dark:bg-gray-700">
<main class="md:ml-90 p-4">
    {{ $slot }}
</main>
@livewireScripts
</body>
