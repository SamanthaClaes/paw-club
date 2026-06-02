@extends('layouts.login')

@php

    $images = [
        'img/login/cat.webp',
        'img/login/dog.webp',
        'img/login/dog2.webp',
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
                {{ __('registerForm.title') }}
            </h1>
            <form action="{{ route('register.store') }}" method="POST" class="w-full max-w-md flex flex-col gap-4"
                  enctype="multipart/form-data">
                @csrf
                <div>
                    <x-forms.input-label
                        label=" {{ __('registerForm.profilePicture') }}"
                        type="file"
                        name="image"
                    />
                </div>
                <div class="flex gap-8">
                    <x-forms.input-label
                        label="{{ __('registerForm.lastName') }}"
                        name="last_name"
                        type="text"
                        placeholder="Martin"
                    />
                    <x-forms.input-label
                        label=" {{ __('registerForm.firstName') }}"
                        name="first_name"
                        type="text"
                        placeholder="Jean"
                    />
                </div>
                <div>
                    <x-forms.input-label
                        label="{{ __('registerForm.address') }}"
                        name="adress"
                        type="text"
                        placeholder="adresse et numéro"
                    />
                </div>
                <div>
                    <x-forms.input-label
                        label=" {{ __('registerForm.phone') }}"
                        type="tel"
                        name="phone"
                        placeholder="0498 xx.xx.xx"
                    />
                </div>
                <div class="flex gap-8">
                    <x-forms.input-label
                        label="{{ __('registerForm.zip') }}"
                        name="zip"
                        type="number"
                        placeholder="1234"
                    />
                    <x-forms.input-label
                        label="{{ __('registerForm.location') }}"
                        name="location"
                        type="text"
                        placeholder="Liege"
                    />
                </div>
                <div>
                    <x-forms.input-label
                        label="{{ __('registerForm.email') }}"
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
                        {{ __('registerForm.password') }}
                    </label>

                    <div class="relative w-full">
                        <input
                            :type="type"
                            name="password"
                            placeholder="{{ __('registerForm.passwordPlaceholder') }}"
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
                                alt="{{ __('registerForm.passwordAlt') }}"
                            >
                        </button>
                    </div>
                    <span class="text-text text-sm font-semibold">{{ __('registerForm.passwordValidation') }}</span>
                </div>
                <div>
                    <x-forms.input-label
                        type="password"
                        label="{{ __('registerForm.confirmPassword') }}"
                        name="password_confirmation"
                        placeholder="{{ __('registerForm.confirmPasswordPlaceholder') }}"
                    />
                </div>
                <button type="submit"
                        class="bg-text text-white py-3 rounded-lg font-bold uppercase mt-6 cursor-pointer mb-20">
                    {{ __('registerForm.submit') }}
                </button>

            </form>
        </section>

        <div class=" hidden lg:block h-full">
            <img src="{{ asset($image) }}" alt="  {{ __('registerForm.imageAlt') }}"
                 class="w-full h-full object-cover">
        </div>

    </div>
@endsection
