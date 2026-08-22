@php use App\Enums\PetsitterRequestStatus;use Carbon\Carbon; @endphp
@props([
    'request',
    'viewer',
    'variant' => 'request',
])

<article
    class="relative rounded-3xl border border-stroke bg-card p-6 shadow-sm transition-all duration-300 hover:shadow-lg"
>

    @if($viewer === 'petsitter' && $variant === 'request' && $request->status === PetsitterRequestStatus::PENDING)

        <span
            class="absolute -top-3 -right-4 rounded-full px-3 py-2 text-xs font-bold
            {{ $request->previous_stays_count === 0
                ? 'bg-blue-100 text-blue-800'
                : 'bg-green-100 text-green-800' }}"
        >
            {{ $request->previous_stays_count === 0
                ? __('ui.first_stay')
                : __('ui.stays', ['count' => $request->previous_stays_count]) }}
        </span>

    @endif

    <div class="flex flex-col gap-6 lg:flex-row">

        <div class="relative h-52 w-full lg:w-52">

            <img
                src="{{ $request->pet->getImageUrl(800) }}"
                alt="{{ __('ui.pet_photo', ['name' => $request->pet->name]) }}"
                class="h-full w-full rounded-2xl object-cover"
            >

            <div
                class="absolute -bottom-3 left-1/2 -translate-x-1/2
        bg-card-green text-text text-xs font-bold
        px-3 py-2 rounded-full shadow-md
        whitespace-nowrap"
            >
                {{ $request->pet->gender
                    ? __('ui.male')
                    : __('ui.female') }}
                -
                {{ $request->pet->birthDateFormat() }}
            </div>

        </div>

        <div class="flex-1 space-y-6">

            <div class="flex flex-col justify-between gap-3 sm:flex-row">

                <div>

                    <h2 class="text-2xl font-extrabold uppercase text-text">
                        {{ $request->pet->name }}
                    </h2>

                    <p>
                        {{ __('animalTypes.' . $request->pet->animalType?->type) }}
                        ·
                        {{ __('breed.' . $request->pet->breed?->name) }}
                    </p>

                </div>

                <span
                    class="h-fit rounded-full px-4 py-1 text-xs font-bold uppercase
                    {{ $request->status === PetsitterRequestStatus::PENDING
                        ? 'bg-yellow-100 text-yellow-700'
                        : ($request->status === PetsitterRequestStatus::ACCEPTED
                            ? 'bg-green-100 text-green-700'
                            : ($request->status === PetsitterRequestStatus::MODIFICATION_REQUESTED
                                ? 'bg-blue-100 text-blue-700'
                                : 'bg-red-100 text-red-600')) }}"
                >
                    {{ $request->status === PetsitterRequestStatus::PENDING
                        ? __('ui.pending')
                        : ($request->status === PetsitterRequestStatus::ACCEPTED
                            ? __('ui.accepted')
                            : ($request->status === PetsitterRequestStatus::MODIFICATION_REQUESTED
                                ? __('ui.modification_requested')
                                : __('ui.refused'))) }}
                </span>

            </div>

            <div>
                <div class="rounded-2xl bg-white p-4 text-sm text-text">

                    <strong class="block text-base">
                        {{ $viewer === 'petsitter'
                            ? __('ui.owner')
                            : __('ui.petsitter') }}
                    </strong>

                    @if($viewer === 'petsitter')

                        <p class="mt-1 font-semibold">
                            {{ $request->user->first_name }}
                            {{ $request->user->last_name }}
                        </p>

                        <a
                            class="mt-1 block break-all underline"
                            href="mailto:{{ $request->user->email }}"
                        >
                            {{ $request->user->email }}
                        </a>

                        @if($request->user->phone)
                            <a
                                class="mt-1 block underline"
                                href="tel:{{ $request->user->phone }}"
                            >
                                {{ $request->user->phone }}
                            </a>
                        @endif

                        @if($request->user->adress || $request->user->zip || $request->user->location)

                            <p class="mt-2 text-gray-600">
                                {{ $request->user->adress }}<br>
                                {{ $request->user->zip }}
                                {{ $request->user->location }}
                            </p>

                        @endif

                    @else

                        <p class="mt-1 font-semibold">
                            {{ $request->petsitter->first_name }}
                            {{ $request->petsitter->last_name }}
                        </p>

                        <a
                            class="mt-1 block break-all underline"
                            href="mailto:{{ $request->petsitter->email }}"
                        >
                            {{ $request->petsitter->email }}
                        </a>

                        @if($request->petsitter->phone)

                            <a
                                class="mt-1 block underline"
                                href="tel:{{ $request->petsitter->phone }}"
                            >
                                {{ $request->petsitter->phone }}
                            </a>

                        @endif

                    @endif

                </div>

            </div>

            <div class="rounded-2xl bg-white p-5">

                <strong>
                    {{ __('ui.dates') }}
                </strong>

                <p>
                    {{ __('ui.start') }} :
                    {{ Carbon::parse($request->start_date)->format('d/m/Y') }}

                </p>
                —
                <p>
                    {{ __('ui.end') }} :
                    {{ Carbon::parse($request->end_date)->format('d/m/Y') }}
                </p>

            </div>

            @if($request->status === PetsitterRequestStatus::MODIFICATION_REQUESTED)

                <div class="rounded-2xl bg-blue-50 p-4">

                    <strong>
                        {{ __('ui.proposed_dates') }}
                    </strong>

                    <p>
                        {{ Carbon::parse($request->requested_start_date)->format('d/m/Y') }}
                        —
                        {{ Carbon::parse($request->requested_end_date)->format('d/m/Y') }}
                    </p>

                    <p>
                        {{ $request->requested_description }}
                    </p>

                </div>

            @elseif($request->description)

                <div class="rounded-2xl bg-background p-4">

                    <strong>
                        {{ __('ui.instructions') }}
                    </strong>

                    <p>
                        {{ $request->description }}
                    </p>

                </div>

            @endif

            @if($variant === 'request' && $viewer === 'petsitter' && $request->status === PetsitterRequestStatus::PENDING)

                <div class="grid grid-cols-2 gap-4">

                    <button
                        wire:click="acceptRequest({{ $request->id }})"
                        class="rounded-xl bg-btn-green py-3 font-bold text-text
               hover:bg-hover-green hover:text-white
               transition cursor-pointer"
                    >
                        {{ __('ui.accept') }}
                    </button>

                    <button
                        wire:click="refusedRequest({{ $request->id }})"
                        class="rounded-xl bg-btn-red py-3 font-bold text-text-red
               hover:bg-red-600 hover:text-white
               transition cursor-pointer"
                    >
                        {{ __('ui.refuse') }}
                    </button>

                </div>

            @elseif($variant === 'request' && $viewer === 'petsitter' && $request->status === PetsitterRequestStatus::ACCEPTED)

                <button
                    wire:click="openModifyModal({{ $request->id }})"
                    class="rounded-xl bg-blue-400 px-5 py-3 font-bold text-white"
                >
                    {{ __('ui.edit_request') }}
                </button>

            @elseif($variant === 'modification-received')

                <div class="grid grid-cols-2 gap-4">

                    <button
                        wire:click="acceptModification({{ $request->id }})"
                        class="rounded-xl bg-btn-green py-3 font-bold"
                    >
                        {{ __('ui.accept_modification') }}
                    </button>

                    <button
                        wire:click="refuseModification({{ $request->id }})"
                        class="rounded-xl bg-btn-red py-3 font-bold"
                    >
                        {{ __('ui.refuse_modification') }}
                    </button>

                </div>

            @elseif($variant === 'modification-sent')

                <button
                    wire:click="cancelModification({{ $request->id }})"
                    class="rounded-xl bg-btn-red px-5 py-3 font-bold"
                >
                    {{ __('ui.cancel_modification') }}
                </button>

            @endif

        </div>

    </div>

</article>
