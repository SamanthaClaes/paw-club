<?php

use App\Enums\DayCareRequestStatus;
use App\Models\DayCareRequest;
use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Dashboard'])]
class extends Component {
    public $currentWeekRequests = [];
    public $lastWeekRequests = [];
    public $selectedOwner = null;

    public function mount(): void
    {
        $startLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endLastWeek = Carbon::now()->subWeek()->endOfWeek();
        $startCurrentWeek = Carbon::now()->startOfWeek();
        $endCurrentWeek = Carbon::now()->endOfWeek();

        $this->currentWeekRequests = DayCareRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed'
        ])
            ->where('status', DayCareRequestStatus::ACCEPTED)
            ->whereBetween('start_date', [
                $startCurrentWeek,
                $endCurrentWeek,
            ])->get();

        $this->lastWeekRequests = DayCareRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed'
        ])->where('status', DayCareRequestStatus::ACCEPTED)
            ->whereBetween('start_date', [
                $startLastWeek,
                $endLastWeek,
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

    #[Computed]
    public function petsCount(): int
    {
        return DayCareRequest::where('status', DayCareRequestStatus::ACCEPTED)->count();
    }

    #[Computed]
    public function requestPending(): int
    {
        return DayCareRequest::where('status', DayCareRequestStatus::PENDING)->count();
    }
};
?>

<div>
    <div class=" md:ml-25 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <x-cards.dashboard_card :number="$this->petsCount" title="Chiens présents"
                                    route=""/>
        </div>
        <div>
            <x-cards.dashboard_card :number="$this->requestPending" title="Demandes non traitées"
                                    route=""/>
        </div>
        <div>
            <x-cards.dashboard_card :number="4" title="Messages non lus"
                                    route=""/>
        </div>
    </div>
    <div>

    </div>
    <section class="md:ml-25 mb-6 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Chiens présents cette
            semaine</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Nom</th>
                <th class="border-r">Race</th>
                <th class="border-r">Genre</th>
                <th class="border-r">Date de garde</th>
                <th class="border-r">Fiche du propriétaire</th>
            </tr>
            </thead>
            <tbody>
            @forelse($currentWeekRequests as $request)
                <tr>
                    <x-table.table-data>
                        {{$request->pet->name}}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{$request->pet->breed->name}}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{$request->pet->gender ? 'Mâle' : 'Femelle'}}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ Carbon::parse($request->start_date)->format('d/m/Y')  }}
                        - {{ Carbon::parse($request->end_date)->format('d/m/Y')  }}
                    </x-table.table-data>
                    <x-table.table-data>
                        <button wire:click="$dispatch('open-owner-modal', { userId: {{ $request->user->id }} })">
                            Voir la fiche du propriétaire
                        </button>
                    </x-table.table-data>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="bg-white p-3">Pas d’animaux trouvés</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class=" flex justify-end mt-6">
            <x-cta.add title="+ Ajouter un chien"/>
        </div>
    </div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Chiens présents la semaine
            dernière</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Nom</th>
                <th class="border-r">Race</th>
                <th class="border-r">Genre</th>
                <th class="border-r">Date de garde</th>
                <th class="border-r">Fiche du propriétaire</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @forelse($lastWeekRequests as $request)
                <x-table.table-data>
                    {{ $request->pet->name }}
                </x-table.table-data>
                <x-table.table-data>
                    {{ $request->pet->breed->name }}
                </x-table.table-data>
                <x-table.table-data>
                    {{ $request->pet->gender ? 'Mâle' : 'Femelle' }}
                </x-table.table-data>
                <x-table.table-data>
                    {{ Carbon::parse( $request->start_date )->format('d/m/Y')}} - {{ Carbon::parse($request->end_date)->format('d/m/Y')  }}
                </x-table.table-data>
                <x-table.table-data>
                    <button wire:click="$dispatch('open-owner-modal', { userId: {{ $request->user->id }} })">
                        Voir la fiche du propriétaire
                    </button>
                </x-table.table-data>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="bg-white p-3">Pas d’animaux trouvés</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
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
                <a href="mailto:{{ $selectedOwner?->email }}" class="font-bold">{{ $selectedOwner?->email }}</a>
            </p>
            <p class="text-text text-lg mb-10">
                Télépone :
                <a href="tel:{{ $selectedOwner?->phone }}" class="font-bold">{{ $selectedOwner?->phone }}</a>
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
</div>
