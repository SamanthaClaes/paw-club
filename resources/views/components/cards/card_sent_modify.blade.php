@props([
    'request',
])

<div
    class="mb-20 mt-10 rounded-lg bg-card border border-stroke shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1">

    <div class="bg-blue-100 border-b border-stroke px-6 py-4">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <h2 class="font-bold text-blue-700 uppercase">
                Modification envoyée
            </h2>

            <span class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-full text-sm font-bold px-3 py-1">
                En attente de réponse
            </span>

        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 p-6 gap-6">

        <div class="flex flex-col items-center lg:items-start">

            <div class="relative inline-block">

                <img
                    src="{{ Storage::url($request->pet->pet_image) }}"
                    alt="Photo de {{ $request->pet->name }}"
                    class="w-full max-w-64 h-64 rounded-2xl object-cover"
                >

                <div
                    class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-card-green text-text text-xs font-bold px-3 py-2 rounded-full shadow-md whitespace-nowrap max-w-[90%] text-center">
                    {{ $request->pet->breed?->name }}
                </div>

            </div>

        </div>

        <div class="lg:col-span-2 flex flex-col gap-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="bg-white rounded-2xl p-5 shadow-sm">

                    <h2 class="text-xl font-bold text-text mb-4">
                        Animal
                    </h2>

                    <div class="space-y-3 text-text">

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Nom
                            </p>

                            <p class="text-base font-bold">
                                {{ $request->pet->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Genre
                            </p>

                            <p class="text-base font-bold">
                                {{ $request->pet->gender ? 'Mâle' : 'Femelle' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Type
                            </p>

                            <p class="text-base font-bold">
                                {{ $request->pet->animalType?->type }}
                            </p>
                        </div>

                    </div>

                </div>

                <div class="bg-white rounded-2xl p-3 shadow-sm">

                    <h2 class="text-xl font-bold text-text mb-4">
                        Petsitter
                    </h2>

                    <div class="space-y-3 text-text">

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Nom complet
                            </p>

                            <p class="text-base font-bold">
                                {{ $request->petsitter->first_name }}
                                {{ $request->petsitter->last_name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Téléphone
                            </p>

                            <p class="text-base font-bold">
                                {{ $request->petsitter->phone }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Email
                            </p>

                            <p class="text-base font-bold break-all">
                                {{ $request->petsitter->email }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                <div class="bg-white rounded-2xl p-5 shadow-sm">

                    <h2 class="text-xl font-bold text-text mb-4">
                        Dates actuelles
                    </h2>

                    <div class="flex flex-col gap-3">

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase mb-1">
                                Début
                            </p>

                            <p class="text-base font-bold text-text">
                                {{ Carbon\Carbon::parse($request->start_date)->format('d/m/Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase mb-1">
                                Fin
                            </p>

                            <p class="text-base font-bold text-text">
                                {{ Carbon\Carbon::parse($request->end_date)->format('d/m/Y') }}
                            </p>
                        </div>

                    </div>

                </div>

                <div class="bg-blue-50 border border-stroke rounded-2xl p-5 shadow-sm">

                    <h2 class="text-xl font-bold text-blue-700 mb-4">
                        Nouvelles dates proposées
                    </h2>

                    <div class="flex flex-col gap-3">

                        <div>
                            <p class="text-xs font-medium text-blue-600 uppercase mb-1">
                                Début
                            </p>

                            <p class="text-base font-bold text-blue-700">
                                {{ Carbon\Carbon::parse($request->requested_start_date)->format('d/m/Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-blue-600 uppercase mb-1">
                                Fin
                            </p>

                            <p class="text-base font-bold text-blue-700">
                                {{ Carbon\Carbon::parse($request->requested_end_date)->format('d/m/Y') }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            <div class="bg-blue-50 border border-stroke rounded-2xl p-5">

                <h2 class="text-lg font-bold text-blue-700 mb-3">
                   Votre message
                </h2>

                <p class="text-text leading-7">
                    {{ $request->requested_description }}
                </p>

            </div>

            <div class="flex flex-col items-center gap-4">

                <button
                    wire:click="cancelModification({{ $request->id }})"
                    class="bg-btn-red hover:bg-red-500 text-white font-bold py-3 px-8 rounded-2xl transition cursor-pointer"
                >
                    Annuler la demande
                </button>

            </div>

        </div>

    </div>

</div>
