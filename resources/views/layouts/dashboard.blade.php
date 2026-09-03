<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/webp" href="{{ asset('img/logo.webp') }}">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @fluxAppearance
</head>

<body class="bg-background text-text dark:bg-slate-900 dark:text-white">

<h1 class="sr-only">{{ __('ui.admin_pages') }}</h1>

<header>
    <x-header.sideBar/>
</header>

<main class="md:ml-90 p-4">
    {{ $slot }}
</main>

@livewireScripts
@fluxScripts

</body>
</html>
