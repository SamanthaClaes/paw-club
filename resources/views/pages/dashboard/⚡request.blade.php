<?php

use App\Enums\DayCareRequestStatus;
use App\Models\DayCareRequest;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Demandes de garde'])]
class extends Component {
    public $requests = [];
    public ?User $selectedOwner = null;

    public function mount(): void
    {
        $this->requests = DayCareRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed',
        ])->get();
    }

    #[On('open-owner-modal')]
    public function loadOwner($userId): void
    {
        $this->selectedOwner = User::with([
            'pets',
            'pets.breed',
            'pets.animalType',
        ])->findOrFail($userId);
    }

    public function acceptRequest($requestId): void
    {
        $request = DayCareRequest::findOrFail($requestId);

        $request->status = DayCareRequestStatus::ACCEPTED;

        $request->save();

        $this->requests = DayCareRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed',
        ])
            ->where('status', DayCareRequestStatus::PENDING)
            ->get();
    }
};
?>

<div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h1 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des demandes de
            garde</h1>
    </section>
    @foreach($requests as $request)
        <section class="border-5 border-stroke rounded-md overflow-hidden bg-card w-full mt-6 lg:max-w-3xl ml-25">
            <div class="flex flex-col sm:flex-row h-full">
                <div class="w-full h-64 sm:h-auto sm:w-1/3">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($request->pet->pet_image) }}"
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
                            Informations de {{ $request->pet->name }}
                        </h1>

                        <div class="space-y-3 sm:space-y-4 text-text text-sm sm:text-base">
                            <p>
                                <span class="font-extrabold"> Date de garde : </span>
                                {{ Carbon::parse($request->start_date)->format('d/m/Y')  }} -
                                {{ Carbon::parse($request->end_date)->format('d/m/Y')  }}
                            </p>
                            <p>
                                <span class="font-extrabold">Nom :</span>
                                {{ $request->pet->name }}
                            </p>

                            <p>
                                <span class="font-extrabold">Race :</span>
                                {{ $request->pet->breed->name }}
                            </p>

                            <p>
                                <span class="font-extrabold">Âge :</span>
                                {{ $request->pet->birthDateFormat() }}
                            </p>

                            <p class="leading-relaxed">
                                <span class="font-extrabold">Besoins spécifiques :</span>
                                {{ $request->pet->description }}
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
                            class="bg-btn-red hover:bg-red-700 text-red-950 text-sm hover:text-white font-extrabold uppercase px-4 sm:px-6 py-3 rounded-md transition w-full cursor-pointer"
                        >
                            Refuser la demande
                        </button>

                    </div>

                </div>

            </div>
        </section>
        <dialog
            wire:ignore.self
            x-data="{ open: false }"

            x-on:open-owner-modal.window="
        open = true;
        $el.showModal();
        "

            x-on:close="
        open = false;
        "

            x-cloak
            class="rounded-2xl
    backdrop:bg-black/50
    w-full
    max-w-2xl
    shadow-xl
    fixed
    top-1/2
    left-1/2
    -translate-x-1/2
    -translate-y-1/2
    m-0
"
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

                <h2 class="text-2xl font-extrabold text-text uppercase mb-6">
                    Information du propriétaire
                </h2>
                <p class="text-text text-lg mb-10">
                    Prénom :
                    <span class="text-text font-bold">{{ $selectedOwner?->first_name }}</span>
                </p>
                <p class="text-text text-lg mb-10">
                    Nom :
                    <span class="text-text font-bold"> {{ $selectedOwner?->last_name }}</span>
                </p>
                <p class="text-text text-lg mb-10">
                    Email :
                    <a href="mailto:{{ $selectedOwner?->email }}" class="font-bold">{{ $request->user->email }}</a>
                </p>
                <p class="text-text text-lg mb-10">
                    Télépone :
                    <a href="tel:{{ $selectedOwner?->phone }}" class="font-bold">{{ $request->user->phone }}</a>
                </p>

                <div class="flex justify-end gap-4">

                    <button
                        type="button"
                        @click="
                    open = false;

                    $el.closest('dialog').close();
                "
                        class="border-2 border-gray-300 px-6 py-3 rounded-lg font-bold uppercase hover:bg-gray-100 transition cursor-pointer"
                    >
                        Fermer la modale
                    </button>

                </div>

            </div>

        </dialog>
    @endforeach
</div>
