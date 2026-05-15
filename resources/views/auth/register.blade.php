
@extends('layouts.login')

@php

    $images = [
        'img/login/cat.jpg',
        'img/login/dog.jpg',
        'img/login/dog2.jpg',
    ];
    $image = $images[array_rand($images)];

@endphp
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 min-h-screen">
    <section class="bg-element flex flex-col items-center justify-center px-12">
        <div>
            <x-svg.logo class="w-89 h-89 mb-8"/>
        </div>
        <h1 class="text-3xl font-bold text-text mb-8 uppercase">
            Enregistrez vous
        </h1>
        <form action="{{ route('register') }}" method="POST" class="w-full max-w-md flex flex-col gap-4">
            @csrf
            <div class="flex gap-8">
            <x-forms.input-label
                label="Nom *"
                name="last_name"
                type="text"
                placeholder="Jean"
            />
                <x-forms.input-label
                    label="Prénom *"
                    name="first_name"
                    type="text"
                    placeholder="Martin"
                />
            </div>

                <x-forms.input-label
                    label="Adresse *"
                    name="adress"
                    type="text"
                    placeholder="adresse et numéro"
                />
            <div class="flex gap-8">
                <x-forms.input-label
                    label="Code postal*"
                    name="zip"
                    type="number"
                    placeholder="1234"
                />
                <x-forms.input-label
                    label="Localité"
                    name="location"
                    type="text"
                    placeholder="Liege"
                />
            </div>
            <div>
            <x-forms.input-label
                label="Email"
                name="email"
                type="email"
                placeholder="user@mail.be"
            />
            </div>
            <div x-data="{ type: 'password' }">
                <label
                    class="block text-sm text-text uppercase font-bold mb-1"
                    for="password"
                >
                    Mot de passe
                </label>

                <div class="relative w-full">
                    <input
                        :type="type"
                        name="password"
                        placeholder="Entrez votre mot de passe"
                        class="w-full bg-white rounded-lg px-3 py-2"
                    >

                    <button
                        type="button"
                        @click="type = type === 'password' ? 'text' : 'password'"
                        class="absolute inset-y-0 right-2 flex items-center text-sm cursor-pointer"
                    >
                        <img
                            :src="type === 'password'
                    ? '{{ asset('svg/v.svg') }}'
                    : '{{ asset('svg/v_off.svg') }}'"
                            alt="Afficher et cacher le mot de passe"
                        >
                    </button>
                </div>
            </div>

            <button type="submit" class="bg-text text-white py-3 rounded-lg font-bold uppercase mt-6">
                Se connecter
            </button>

            <div class="text-sm text-center mt-2">
                <a href="#" class="underline">Pas encore de compte ?</a>
            </div>

            <div class="text-sm text-center">
                <a href="#" class="underline">Mot de passe oublié ?</a>
            </div>

        </form>
    </section>

    <div class=" hidden lg:block h-full">
        <img src="{{ asset($image) }}" alt="plusieurs images de chiens ou de chats"
             class="w-full h-full object-cover">
    </div>

</div>
@endsection
