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

        $this->currentWeekRequests = $this->requestsBetween(
            $startCurrentWeek,
            $endCurrentWeek
        );

        $this->lastWeekRequests = $this->requestsBetween(
            $startLastWeek,
            $endLastWeek
        );
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
    public function requestsBetween($start, $end)
    {
        return $this->daycareRequests()
            ->where('start_date', '<=', $end)
            ->where('end_date', '>=', $start)
            ->get();
    }
    public function daycareRequests()
    {
        return DayCareRequest::with([
            'user',
            'pet',
            'pet.animalType',
            'pet.breed',
        ])
            ->where('status', DayCareRequestStatus::ACCEPTED);
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
    <div class=" mt-20 md:ml-25 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <x-cards.dashboard_card :number="$this->petsCount" title="Chiens présents"
                                    route="{{ 'dashboard/dogs' }}" class="bg-element"/>
        </div>
        <div>
            <x-cards.dashboard_card :number="$this->requestPending" title="Demandes non traitées"
                                    route="{{ 'dashboard/request' }}" class="bg-element"/>
        </div>
        <div>
            <x-cards.dashboard_card :number="$this->unreadMessageCount" title="Messages non lus"
                                    route="{{ 'dashboard/messages' }}" class="bg-element"/>
        </div>
    </div>
    <div>
        <x-dashboard.daycare-table
            title="Chiens présents cette semaine"
            :requests="$currentWeekRequests"
        />
        <x-dashboard.daycare-table
            title="Chiens présent la semaine dernière"
            :requests="$lastWeekRequests"
        />
    </div>
    <x-modale.owner_infos_modale
        :selected-owner="$selectedOwner"
    />
</div>
