<?php

use App\Enums\DayCareRequestStatus;
use App\Models\ContactMessage;
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
            ->where('start_date', '<=', $endCurrentWeek)
            ->where('end_date', '>=', $startCurrentWeek)
            ->get();

        $this->lastWeekRequests = DayCareRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed'
        ])
            ->where('status', DayCareRequestStatus::ACCEPTED)
            ->where('start_date', '<=', $endLastWeek)
            ->where('end_date', '>=', $startLastWeek)
            ->get();
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
        $startCurrentWeek = Carbon::now()->startOfWeek();
        $endCurrentWeek = Carbon::now()->endOfWeek();
        return DayCareRequest::where('status', DayCareRequestStatus::ACCEPTED)
            ->where('start_date', '<=', $endCurrentWeek)
            ->where('end_date', '>=', $startCurrentWeek)
            ->count();
    }

    #[Computed]
    public function unreadMessageCount(): int
    {
        return ContactMessage::where('is_read', false)->count();
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
                                    route="{{ 'dashboard/dogs' }}"/>
        </div>
        <div>
            <x-cards.dashboard_card :number="$this->requestPending" title="Demandes non traitées"
                                    route="{{ 'dashboard/request' }}"/>
        </div>
        <div>
            <x-cards.dashboard_card :number="$this->unreadMessageCount" title="Messages non lus"
                                    route="{{ 'dashboard/messages' }}"/>
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
                        <button class="cursor-pointer"
                                wire:click="$dispatch('open-owner-modal', { userId: {{ $request->user->id }} })">
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
                        {{ Carbon::parse( $request->start_date )->format('d/m/Y')}}
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
    </div>
    <x-modale.owner_infos_modale
        :selected-owner="$selectedOwner"
    />
</div>
