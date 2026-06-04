<?php

use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Terms | Paw-club')]
class extends Component {
    //
};
?>

<div class="bg-card min-h-screen py-16">
    <section class="max-w-5xl mx-auto px-6">

        <div class="text-center mb-16">
            <h1 class="text-4xl lg:text-5xl font-bold text-card-blue mb-6">
                {{ __('terms.title') }}
            </h1>

            <p class="text-text text-lg max-w-3xl mx-auto leading-relaxed">
                {{ __('terms.subtitle') }}
            </p>

            <span class="block mt-6 text-sm text-gray-500">
                {{ __('terms.updated') }}{{ Carbon::now()->format('m/Y') }}
            </span>
        </div>

        <div class="flex flex-col gap-8">

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('terms.platformTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('terms.platformText') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('terms.accountsTitle') }}
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    {{ __('terms.accountsText') }}
                </p>

                <ul class="list-disc pl-6 text-text flex flex-col gap-2">
                    <li>{{ __('terms.owners') }}</li>
                    <li>{{ __('terms.petsitters') }}</li>
                    <li>{{ __('terms.admins') }}</li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('terms.bookingTitle') }}
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    {{ __('terms.bookingText') }}
                </p>

                <p class="text-text leading-relaxed">
                    {{ __('terms.bookingValidation') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('terms.responsabilitiesTitle') }}
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    {{ __('terms.responsabilitiesText') }}
                </p>

                <p class="text-text leading-relaxed">
                    {{ __('terms.responsabilitiesText2') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('terms.datasTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('terms.datasText') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('terms.deleteTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('terms.deleteText') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('terms.contactTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('terms.contactText') }}
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
