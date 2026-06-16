<div
    class="mb-20 mt-10 rounded-lg bg-card border border-element shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 ">

    <div class="grid grid-cols-1 lg:grid-cols-3 p-6 gap-6">

        <div class="flex flex-col items-center lg:items-start">

            <div class="relative inline-block">

                <img
                    src="{{ $request->pet->getImageUrl(800) }}"
                    srcset="
        {{ $request->pet->getImageUrl(400) }} 400w,
        {{ $request->pet->getImageUrl(800) }} 800w,
        {{ $request->pet->getImageUrl(1200) }} 1200w
    "
                    sizes="(max-width: 768px) 100vw, 300px"
                    alt="Photo de {{ $request->pet->name }}"
                    class="w-100 h-100 rounded-2xl object-cover"
                >

                <div
                    class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-card-green text-text text-xs font-bold px-3 py-2 rounded-full shadow-md whitespace-nowrap max-w-[90%] text-center">
                    {{ __('breed.' . $request->pet?->breed?->name) }}
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

                <div class="bg-white rounded-2xl p-5 shadow-sm">

                    <h2 class="text-xl font-bold text-text mb-4">
                        Propriétaire
                    </h2>

                    <div class="space-y-3 text-text">

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Nom complet
                            </p>

                            <p class="text-base font-bold">
                                {{ $request->user->first_name }}
                                {{ $request->user->last_name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Téléphone
                            </p>

                            <p class="text-base font-bold">
                                <a href="tel:{{ $request->user->phone }}">
                                    {{ $request->user->phone }}
                                </a>
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase">
                                Email
                            </p>

                            <a
                                href="mailto:{{ $request->user->email }}"
                                class="text-base font-bold hover:underline break-all"
                            >
                                {{ $request->user->email }}
                            </a>
                        </div>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm">

                <h2 class="text-xl font-bold text-text mb-4">
                    Dates de garde
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    <div class="rounded-2xl p-3">

                        <p class="text-xs font-medium text-gray-500 uppercase mb-1">
                            Début
                        </p>

                        <p class="text-base font-bold text-text">
                            {{ Carbon\Carbon::parse($request->start_date)->format('d/m/Y') }}
                        </p>

                    </div>

                    <div class="rounded-2xl p-3">

                        <p class="text-xs font-medium text-gray-500 uppercase mb-1">
                            Fin
                        </p>

                        <p class="text-base font-bold text-text">
                            {{ Carbon\Carbon::parse($request->end_date)->format('d/m/Y') }}
                        </p>

                    </div>

                </div>

            </div>

            <div class="bg-card rounded-2xl p-4 min-h-24">

                @if($request->note)

                    <p class="text-sm text-text whitespace-pre-line">
                        {{ $request->note }}
                    </p>

                @else

                    <p class="text-sm text-gray-500 italic">
                        Aucune note pour le moment.
                    </p>

                @endif

            </div>

            <div class="flex flex-col sm:flex-row gap-3">

                <a
                    href="mailto:{{ $request->user->email }}"
                    class="flex-1 bg-card-green hover:bg-hover text-text text-center font-bold text-base py-3 rounded-2xl transition-all duration-300 shadow-md"
                >
                    Contacter {{ $request->user->first_name }}
                </a>

                <button
                    type="button"
                    x-on:click="$dispatch('open-note-modal')"
                    class="flex-1 border-2 border-card-green text-card-green hover:bg-card-green hover:text-white font-bold text-base py-3 rounded-2xl transition-all duration-300 cursor-pointer"
                >
                    Ajouter une note
                </button>

            </div>

        </div>

    </div>

</div>
