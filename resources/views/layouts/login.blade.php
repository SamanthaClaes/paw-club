<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/webp" href="{{ asset('img/logo.webp') }}">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="dark:bg-gray-700 bg-element">
<main>
    <h1 class="sr-only">{{ __('ui.login_page') }}</h1>
    @yield( 'content')
</main>
@livewireScripts
</body>
</html>
