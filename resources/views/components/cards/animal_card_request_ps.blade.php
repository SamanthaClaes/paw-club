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
            {{ __('ui.first_stay') }}
        </span>

            @else

                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold">
            {{ __('ui.stays', ['count' => $request->previous_stays_count]) }}
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
                    {{ __('animalTypes.' . $request->pet->animalType?->type) }}
                    -
                    {{ __('breed.' . $request->pet->breed?->name) }}
                    -
                    {{ $request->pet->birthDateFormat() }}
                </p>

            </div>

        </div>

        <div class="text-right">

            @if($request->status == PetsitterRequestStatus::PENDING)

                <span class="bg-yellow-100 text-yellow-700 px-4 py-1.5 rounded-full font-bold uppercase text-xs">
                {{ __('ui.pending') }}
            </span>

            @elseif($request->status == PetsitterRequestStatus::ACCEPTED)

                <span class="bg-green-100 text-green-700 px-4 py-1.5 rounded-full font-bold uppercase text-xs">
                {{ __('ui.accepted') }}
            </span>

            @elseif($request->status == PetsitterRequestStatus::REFUSED)

                <span class="bg-red-100 text-red-600 px-4 py-1.5 rounded-full font-bold uppercase text-xs">
                {{ __('ui.refused') }}
            </span>

            @endif

            <div class="mt-3">

                <p class="font-bold uppercase text-sm mb-1 text-gray-500">
                    {{ __('ui.dates') }}
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
            <img
                src="{{ $request->pet->getImageUrl(800) }}"
                srcset="
        {{ $request->pet->getImageUrl(400) }} 400w,
        {{ $request->pet->getImageUrl(800) }} 800w,
        {{ $request->pet->getImageUrl(1200) }} 1200w
    "
                sizes="(max-width: 768px) 100vw, 300px"
                alt="{{ __('ui.pet_photo', ['name' => $request->pet->name]) }}"
                class="w-full max-w-52 h-52 object-cover rounded-2xl shrink-0"
            >
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-6 text-base text-text w-full">

            <div>

                <p class="font-bold uppercase text-sm mb-1 text-gray-500">
                    {{ __('ui.owner') }}
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
                    {{ __('ui.address') }}
                </p>

                <p>
                    {{ $request->user->adress }}
                </p>

            </div>

            <div>

                <p class="font-bold uppercase text-sm mb-1 text-gray-500">
                    {{ __('ui.city') }}
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
            {{ __('ui.instructions') }}
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
                {{ __('ui.accept') }}
            </button>

            <button
                wire:click="refusedRequest({{ $request->id }})"
                class="bg-btn-red hover:bg-red-500 transition rounded-xl py-3 text-base font-bold text-text-red cursor-pointer"
            >
                {{ __('ui.refuse') }}
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
                {{ __('ui.edit_request') }}
            </button>

        @endif

    </div>

</section>
