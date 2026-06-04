@props([
    'request'
])

<section class="border-5 border-stroke rounded-md overflow-hidden bg-card w-full mt-6 lg:max-w-7xl ml-25">
    <div class="flex flex-col sm:flex-row h-full">
        <div class="w-full h-64 sm:h-auto sm:w-1/3">
            <img
                src="{{ $request->pet->pet_image
        ? Storage::url($request->pet->pet_image)
        : asset('img/default-pet.jpg') }}"
                alt="{{ $request->pet->name }}"
                class="w-full h-full object-cover"
            >
        </div>

        <div class="w-full sm:w-2/3 p-4 sm:p-6 flex flex-col justify-between">
            <div class="flex justify-end  underline">
                <button wire:click="$dispatch('open-owner-modal', { userId: {{ $request->user->id }} })"
                        class="cursor-pointer mb-6">Voir la fiche du propriétaire
                </button>
            </div>
            <div>
                <h1 class="uppercase font-extrabold text-text text-lg sm:text-xl mb-4 sm:mb-6">
                    Informations de {{ $request->pet?->name }}
                </h1>

                <div class="space-y-3 sm:space-y-4 text-text text-sm sm:text-base">
                    <p>
                        <span class="font-extrabold"> Date de garde : </span>
                        {{ Carbon::parse($request->start_date)->format('d/m/Y')  }} -
                        {{ Carbon::parse($request->end_date)->format('d/m/Y')  }}
                    </p>
                    <p>
                        <span class="font-extrabold">Nom :</span>
                        {{ $request->pet?->name }}
                    </p>

                    <p>
                        <span class="font-extrabold">Race :</span>
                        {{ __('breed.' . $request->pet?->breed?->name) }}
                    </p>

                    <p>
                        <span class="font-extrabold">Âge :</span>
                        {{ $request->pet?->birthDateFormat() }}
                    </p>

                    <p class="leading-relaxed">
                        <span class="font-extrabold">Besoins spécifiques :</span>
                        {{ $request->pet?->description }}
                    </p>

                </div>

            </div>

            <div class="flex  gap-4 mt-6">

                <button
                    wire:click="acceptRequest({{$request->id}})"
                    class="bg-btn-green hover:bg-hover text-cta text-sm font-extrabold uppercase px-4 sm:px-6 py-3 rounded-md transition w-full cursor-pointer"
                >
                    Accepter la demande
                </button>

                <button
                    wire:click="rejectRequest({{ $request->id }})"
                    class="bg-btn-red hover:bg-red-700 text-red-950 text-sm hover:text-white font-extrabold uppercase px-4 sm:px-6 py-3 rounded-md transition w-full cursor-pointer"
                >
                    Refuser la demande
                </button>

            </div>

        </div>

    </div>
</section>
