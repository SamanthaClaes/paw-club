
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
            {{ __('login.title') }}
        </h1>
        <form action="{{ route('login') }}" method="POST" class="w-full max-w-md flex flex-col gap-4">
            @csrf
            <x-forms.input-label
                label="Email"
                name="email"
                type="email"
                placeholder="user@mail.be"
            />

            <div x-data="{ type: 'password' }">
                <label
                    class="block text-sm text-text uppercase font-bold mb-1"
                    for="password"
                >
                   {{ __('login.password') }}
                </label>

                <div class="relative w-full">
                    <input
                        :type="type"
                        name="password"
                        placeholder="{{ __('login.passwordPlaceholder') }}"
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

            <button type="submit" class="bg-text text-white py-3 rounded-lg font-bold uppercase cursor-pointer">
                {{ __('login.submit') }}
            </button>

            <div class="text-sm text-center mt-2">
                <a href="{{ route('register') }}" class="underline">{{ __('login.noAccount') }}</a>
            </div>

            <div class="text-sm text-center">
                <a href="#" class="underline"> {{ __('login.forgotPassword') }}</a>
            </div>

        </form>
    </section>

    <div class=" hidden lg:block h-screen">
        <img src="{{ asset($image) }}" alt="plusieurs images de chiens ou de chats"
             class="w-full h-full object-cover">
    </div>

</div>
@endsection
