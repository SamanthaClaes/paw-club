@php
    use Carbon\Carbon;
    use App\Enums\PetsitterRequestStatus;
@endphp

@props([
   'request'
])

<section class="relative bg-card border border-stroke rounded-3xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 h-full">
    <div class="absolute -top-3 -right-4">

        @if($request->status === PetsitterRequestStatus::PENDING)

            @if($request->previous_stays_count === 0)

                <span class="bg-blue-100 text-blue-800 px-3 py-3 rounded-full text-xs font-bold">
            🐾 Première garde
        </span>

            @else

                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold">
            🐾 {{ $request->previous_stays_count }} garde(s)
        </span>

            @endif

        @endif

    </div>
    <div class="flex flex-col xl:flex-row gap-8 mb-7">

        <div>

            <h1 class="text-2xl font-extrabold uppercase text-text leading-tight">
                {{ $request->pet->name }}
            </h1>

            <div class="mb-6 text-text">

                <p>
                    {{ $request->pet->animalType?->type }}
                    -
                    {{ $request->pet->breed?->name }}
                    -
                    {{ $request->pet->birthDateFormat() }}
                </p>

            </div>

        </div>

        <div class="text-right">

            @if($request->status == PetsitterRequestStatus::PENDING)

                <span class="bg-yellow-100 text-yellow-700 px-4 py-1.5 rounded-full font-bold uppercase text-xs">
                En attente
            </span>

            @elseif($request->status == PetsitterRequestStatus::ACCEPTED)

                <span class="bg-green-100 text-green-700 px-4 py-1.5 rounded-full font-bold uppercase text-xs">
                Acceptée
            </span>

            @elseif($request->status == PetsitterRequestStatus::REFUSED)

                <span class="bg-red-100 text-red-600 px-4 py-1.5 rounded-full font-bold uppercase text-xs">
                Refusée
            </span>

            @endif

            <div class="mt-3">

                <p class="font-bold uppercase text-sm mb-1 text-gray-500">
                    Dates
                </p>

                <p class="text-base text-text">
                    {{ Carbon::parse($request->start_date)->format('d/m/Y') }}
                    →
                    {{ Carbon::parse($request->end_date)->format('d/m/Y') }}
                </p>

            </div>

        </div>

    </div>

    <div class="flex flex-col 2xl:flex-row gap-8 mb-7">
        @if($request->pet->pet_image)
            <img
                src="{{ Storage::disk('s3')->url($request->pet->pet_image) }}"
                alt="{{ $request->pet->name }}"
                class="w-full max-w-52 h-52 object-cover rounded-2xl shrink-0"
            >
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-6 text-base text-text w-full">

            <div>

                <p class="font-bold uppercase text-sm mb-1 text-gray-500">
                    Propriétaire
                </p>

                <p>
                    {{ $request->user?->first_name }}
                    {{ $request->user->last_name }}
                </p>

            </div>

            <div>

                <p class="font-bold uppercase text-sm mb-1 text-gray-500">
                    Email
                </p>

                <a href="mailto:{{ $request->user->email }}" class="underline font-bold">
                    {{ $request->user->email }}
                </a>

            </div>

            <div>

                <p class="font-bold uppercase text-sm mb-1 text-gray-500">
                    Adresse
                </p>

                <p>
                    {{ $request->user->adress }}
                </p>

            </div>

            <div>

                <p class="font-bold uppercase text-sm mb-1 text-gray-500">
                    Ville
                </p>

                <p>
                    {{ $request->user->zip }}
                    -
                    {{ $request->user->location }}
                </p>

            </div>

        </div>

    </div>

    <div class="bg-background border border-element rounded-2xl p-5 mb-6">

        <p class="font-bold uppercase text-sm text-gray-500 mb-3">
            Indications
        </p>

        <p class="text-base text-text leading-7">
            {{ $request->description }}
        </p>

    </div>

    @if($request->status == PetsitterRequestStatus::PENDING)

        <div class="grid grid-cols-2 gap-4">

            <button
                wire:click="acceptRequest({{ $request->id }})"
                class="bg-btn-green hover:bg-green-500 transition rounded-xl py-3 text-base font-bold text-cta cursor-pointer"
            >
                Accepter
            </button>

            <button
                wire:click="refusedRequest({{ $request->id }})"
                class="bg-btn-red hover:bg-red-500 transition rounded-xl py-3 text-base font-bold text-text-red cursor-pointer"
            >
                Refuser
            </button>

        </div>

    @endif
    <div class="flex justify-center mt-6">

        @if($request->status === PetsitterRequestStatus::ACCEPTED)

            <button
                wire:click="openModifyModal({{ $request->id }})"
                type="button"
                class="bg-blue-400 hover:bg-blue-500 transition rounded-xl py-5 px-5 text-lg font-bold text-white cursor-pointer shadow-md"
            >
                Modifier la demande
            </button>

        @endif

    </div>

</section>
