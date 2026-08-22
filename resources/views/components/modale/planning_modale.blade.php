@php
    use Carbon\Carbon;
@endphp

@props([
    'selectedRequest',
])

<dialog
    x-data="{ open: false }"

    x-on:open-petsitting-modal.window="
        open = true;
        document.body.classList.add('overflow-hidden');
        $el.showModal();
    "

    x-on:close="
        open = false;
        document.body.classList.remove('overflow-hidden');
    "

    x-cloak
    class="rounded-2xl p-0 backdrop:bg-black/50 w-full mx-auto max-w-xl m-auto"
>

    <div
        x-show="open"
        x-transition
        @click.outside="
            open = false;
            $el.closest('dialog').close();
        "
        class="bg-white rounded-2xl p-8 relative"
    >

        <button
            type="button"
            @click="
                open = false;
                $el.closest('dialog').close();
            "
            class="absolute top-4 right-4 text-3xl text-text hover:text-red-500 transition cursor-pointer"
        >
            ×
        </button>

        @if($selectedRequest)

            <h2 class="text-2xl font-extrabold text-text uppercase mb-8">
                Détails de la garde
            </h2>

            <div class="space-y-5 text-text">

                <div>
                    <p class="text-sm font-extrabold uppercase">
                        Animal
                    </p>

                    <p class="text-lg">
                        {{ $selectedRequest->pet?->name ?? 'Animal' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-extrabold uppercase">
                        Type
                    </p>

                    <p class="text-lg">
                        {{ ucfirst(__('animalTypes.' . $selectedRequest->pet?->animalType?->type)) }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-extrabold uppercase">
                        Jours de garde
                    </p>

                    <p class="text-lg">
                        Du
                        <strong>
                            {{ Carbon::parse($selectedRequest->start_date)->format('d/m/Y') }}
                        </strong>
                        au
                        <strong>
                            {{ Carbon::parse($selectedRequest->end_date)->format('d/m/Y') }}
                        </strong>
                    </p>
                </div>

            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-end pt-8">

                <a
                    href="{{ route('petsitter.request')}}"
                    class="bg-btn-green hover:bg-hover-green text-white px-6 py-3 rounded-lg font-bold uppercase transition"
                >
                    Modifier
                </a>

                <button
                    type="button"
                    wire:click="confirmDelete({{ $selectedRequest?->id }})"
                    class="bg-btn-red hover:bg-red-600 text-text-red hover:text-white px-6 py-3 rounded-lg font-bold uppercase transition cursor-pointer"
                >
                    Supprimer
                </button>

            </div>

        @endif

    </div>

</dialog>
