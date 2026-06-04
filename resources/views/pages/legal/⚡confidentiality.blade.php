<?php

use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Confidentialités | Paw-club')]
class extends Component {
    //
};
?>

<div class="bg-card min-h-screen py-16">
    <section class="max-w-5xl mx-auto px-6">

        <div class="text-center mb-16">
            <h1 class="text-4xl lg:text-5xl font-bold text-card-blue mb-6">
                {{ __('confidentiality.title') }}
            </h1>

            <p class="text-text text-lg max-w-3xl mx-auto leading-relaxed">
                {{ __('confidentiality.subtitle') }}
            </p>

            <span class="block mt-6 text-sm text-gray-500">
                 {{ __('confidentiality.updated') }} {{ Carbon::now()->format(' M Y') }}
            </span>
        </div>

        <div class="flex flex-col gap-8">

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('confidentiality.collectedDataTitle') }}
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    {{ __('confidentiality.collectedDataText') }}
                </p>

                <ul class="list-disc pl-6 text-text flex flex-col gap-2">
                    <li>{{ __('confidentiality.lastnameFirstname') }}</li>
                    <li>{{ __('confidentiality.email') }}</li>
                    <li>{{ __('confidentiality.phone') }}</li>
                    <li>{{ __('confidentiality.animalsInfos') }}</li>
                    <li>{{ __('confidentiality.pictures') }}</li>
                    <li>{{ __('confidentiality.reservations') }}</li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('confidentiality.dataUsageTitle') }}
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    {{ __('confidentiality.dataUsageText') }}
                </p>

                <ul class="list-disc pl-6 text-text flex flex-col gap-2">
                    <li>{{ __('confidentiality.usersManagement') }}</li>
                    <li>{{ __('confidentiality.requestsManagement') }}</li>
                    <li>{{ __('confidentiality.relationship') }}</li>
                    <li>{{ __('confidentiality.experience') }}</li>
                    <li>{{ __('confidentiality.security') }}</li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('confidentiality.dataConservationTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('confidentiality.dataConservationText') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('confidentiality.dataSecurityTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('confidentiality.dataSecurityText') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('confidentiality.dataSharingTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('confidentiality.dataSharingText') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('confidentiality.rightsTitle') }}
                </h2>

                <p class="text-text leading-relaxed mb-4">
                    {{ __('confidentiality.rightsText') }}
                </p>

                <ul class="list-disc pl-6 text-text flex flex-col gap-2">
                    <li>{{ __('confidentiality.access') }}</li>
                    <li>{{ __('confidentiality.rectification') }}</li>
                    <li>{{ __('confidentiality.deletion') }}</li>
                    <li>{{ __('confidentiality.opposition') }}</li>
                    <li>{{ __('confidentiality.limitation') }}</li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('confidentiality.cookiesTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('confidentiality.cookiesText') }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8 border-2 border-element">
                <h2 class="text-2xl font-bold text-card-blue mb-4">
                    {{ __('confidentiality.contactTitle') }}
                </h2>

                <p class="text-text leading-relaxed">
                    {{ __('confidentiality.contactText') }}
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
