<?php

use App\Enums\DayCareRequestStatus;
use App\Models\ContactMessage;
use App\Models\DayCareRequest;
use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Dashboard | Paw-club'])]
class extends Component {
    public $selectedOwner = null;
    public $search = '';
    public string $currentWeekSortBy = '';
    public string $currentWeekSortDirection = 'asc';

    public string $lastWeekSortBy = '';
    public string $lastWeekSortDirection = 'asc';

    #[Computed]
    public function currentWeekRequests(): LengthAwarePaginator
    {
        $startCurrentWeek = Carbon::now()->startOfWeek();
        $endCurrentWeek = Carbon::now()->endOfWeek();

        $query = $this->daycareRequests()
            ->where('start_date', '<=', $endCurrentWeek)
            ->where('end_date', '>=', $startCurrentWeek)
            ->when($this->search, function ($query) {
                $query->whereHas('pet', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
            });

        if ($this->currentWeekSortBy === 'pet_name') {
            $query
                ->join('pets', 'day_care_requests.pet_id', '=', 'pets.id')
                ->orderBy('pets.name', $this->currentWeekSortDirection)
                ->select('day_care_requests.*');
        }

        return $query->paginate(
            perPage: 4,
            pageName: 'currentWeekPage'
        );
    }
    public function sortCurrentWeek($column)
    {
        if ($this->currentWeekSortBy === $column) {
            $this->currentWeekSortDirection =
                $this->currentWeekSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->currentWeekSortBy = $column;
            $this->currentWeekSortDirection = 'asc';
        }
    }
    public function sortLastWeek($column)
    {
        if ($this->lastWeekSortBy === $column) {
            $this->lastWeekSortDirection =
                $this->lastWeekSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->lastWeekSortBy = $column;
            $this->lastWeekSortDirection = 'asc';
        }
    }


    #[Computed]
    public function lastWeekRequests(): LengthAwarePaginator
    {
        $startLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $query = $this->daycareRequests()
            ->where('start_date', '<=', $endLastWeek)
            ->where('end_date', '>=', $startLastWeek);

        if ($this->lastWeekSortBy === 'pet_name') {
            $query
                ->join('pets', 'day_care_requests.pet_id', '=', 'pets.id')
                ->select('day_care_requests.*')
                ->orderBy('pets.name', $this->lastWeekSortDirection);
        }

        return $query->paginate(
            perPage: 4,
            pageName: 'lastWeekPage'
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

public function deleteDog($petId)
    {
        $dog = Pet::findOrFail($petId);
        $dog->delete();
    }
};
?>

<div>
    <div class=" mt-20 mb-20 md:ml-25 grid grid-cols-1 md:grid-cols-3 gap-4">
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
            :requests="$this->currentWeekRequests"
        />
        <x-dashboard.daycareLastWeek-table
            title="Chiens présent la semaine dernière"
            :requests="$this->lastWeekRequests"
        />
    </div>
    <x-modale.owner_infos_modale
        :selected-owner="$selectedOwner"
    />
</div>
