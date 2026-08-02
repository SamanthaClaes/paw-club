@props(['request', 'viewer', 'variant' => 'request'])

@php
    use App\Enums\PetsitterRequestStatus;
    use Carbon\Carbon;

    $partner = $viewer === 'petsitter' ? $request->user : $request->petsitter;
    $isPending = $request->status === PetsitterRequestStatus::PENDING;
    $isModification = $request->status === PetsitterRequestStatus::MODIFICATION_REQUESTED;
@endphp

<article class="relative rounded-3xl border border-stroke bg-card p-6 shadow-sm transition-all duration-300 hover:shadow-lg">
    @if($viewer === 'petsitter' && $variant === 'request' && $isPending)
        <span class="absolute -top-3 -right-4 rounded-full px-3 py-2 text-xs font-bold {{ $request->previous_stays_count === 0 ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
            {{ $request->previous_stays_count === 0 ? __('ui.first_stay') : __('ui.stays', ['count' => $request->previous_stays_count]) }}
        </span>
    @endif

    <div class="flex flex-col gap-6 lg:flex-row">
        <img src="{{ $request->pet->getImageUrl(800) }}" alt="{{ __('ui.pet_photo', ['name' => $request->pet->name]) }}" class="h-52 w-full rounded-2xl object-cover lg:w-52">

        <div class="flex-1 space-y-6">
            <div class="flex flex-col justify-between gap-3 sm:flex-row">
                <div>
                    <h2 class="text-2xl font-extrabold uppercase text-text">{{ $request->pet->name }}</h2>
                    <p>{{ __('animalTypes.' . $request->pet->animalType?->type) }} · {{ __('breed.' . $request->pet->breed?->name) }} · {{ $request->pet->birthDateFormat() }}</p>
                </div>
                <span class="h-fit rounded-full px-4 py-1 text-xs font-bold uppercase {{ $isPending ? 'bg-yellow-100 text-yellow-700' : ($request->status === PetsitterRequestStatus::ACCEPTED ? 'bg-green-100 text-green-700' : ($isModification ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-600')) }}">
                    {{ $isPending ? __('ui.pending') : ($request->status === PetsitterRequestStatus::ACCEPTED ? __('ui.accepted') : ($isModification ? __('ui.modification_requested') : __('ui.refused'))) }}
                </span>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-2xl bg-white p-4"><strong>{{ __('ui.animal') }}</strong><p>{{ __('ui.gender') }} : {{ $request->pet->gender ? __('ui.male') : __('ui.female') }}</p></div>
                <div class="rounded-2xl bg-white p-4 text-sm text-text">
                    <strong class="block text-base">{{ $viewer === 'petsitter' ? __('ui.owner') : __('ui.petsitter') }}</strong>
                    <p class="mt-1 font-semibold">{{ $partner->first_name }} {{ $partner->last_name }}</p>
                    <a class="mt-1 block break-all underline" href="mailto:{{ $partner->email }}">{{ $partner->email }}</a>
                    @if($partner->phone)
                        <a class="mt-1 block underline" href="tel:{{ $partner->phone }}">{{ $partner->phone }}</a>
                    @endif
                    @if($partner->adress || $partner->zip || $partner->location)
                        <p class="mt-2 text-gray-600">{{ $partner->adress }}<br>{{ $partner->zip }} {{ $partner->location }}</p>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl bg-white p-4"><strong>{{ __('ui.dates') }}</strong><p>{{ __('ui.start') }} : {{ Carbon::parse($request->start_date)->format('d/m/Y') }} — {{ __('ui.end') }} : {{ Carbon::parse($request->end_date)->format('d/m/Y') }}</p></div>

            @if($isModification)
                <div class="rounded-2xl bg-blue-50 p-4"><strong>{{ __('ui.proposed_dates') }}</strong><p>{{ Carbon::parse($request->requested_start_date)->format('d/m/Y') }} — {{ Carbon::parse($request->requested_end_date)->format('d/m/Y') }}</p><p>{{ $request->requested_description }}</p></div>
            @elseif($request->description)
                <div class="rounded-2xl bg-background p-4"><strong>{{ __('ui.instructions') }}</strong><p>{{ $request->description }}</p></div>
            @endif

            @if($variant === 'request' && $viewer === 'petsitter' && $isPending)
                <div class="grid grid-cols-2 gap-4"><button wire:click="acceptRequest({{ $request->id }})" class="rounded-xl bg-btn-green py-3 font-bold">{{ __('ui.accept') }}</button><button wire:click="refusedRequest({{ $request->id }})" class="rounded-xl bg-btn-red py-3 font-bold">{{ __('ui.refuse') }}</button></div>
            @elseif($variant === 'request' && $viewer === 'petsitter' && $request->status === PetsitterRequestStatus::ACCEPTED)
                <button wire:click="openModifyModal({{ $request->id }})" class="rounded-xl bg-blue-400 px-5 py-3 font-bold text-white">{{ __('ui.edit_request') }}</button>
            @elseif($variant === 'modification-received')
                <div class="grid grid-cols-2 gap-4"><button wire:click="acceptModification({{ $request->id }})" class="rounded-xl bg-btn-green py-3 font-bold">{{ __('ui.accept_modification') }}</button><button wire:click="refuseModification({{ $request->id }})" class="rounded-xl bg-btn-red py-3 font-bold">{{ __('ui.refuse_modification') }}</button></div>
            @elseif($variant === 'modification-sent')
                <button wire:click="cancelModification({{ $request->id }})" class="rounded-xl bg-btn-red px-5 py-3 font-bold">{{ __('ui.cancel_modification') }}</button>
            @endif
        </div>
    </div>
</article>
