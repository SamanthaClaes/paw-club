<?php

use App\Enums\DayCareRequestStatus;
use App\Models\DayCareRequest;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

new #[Layout('layouts::dashboard', ['title' => 'Nos chiens | Paw-club'])]
class extends Component {

    use WithPagination;

    public $selectedOwner = null;
    public $search = '';
    public $lastWeeksearch = '';
    public $lastMonthsearch = '';


    #[Computed]
    public function currentWeekRequests(): LengthAwarePaginator
    {
        $startCurrentWeek = Carbon::now()->startOfWeek();
        $endCurrentWeek = Carbon::now()->endOfWeek();

        return $this->daycareRequests()
            ->where('start_date', '<=', $endCurrentWeek)
            ->where('end_date', '>=', $startCurrentWeek)
            ->when($this->search, function ($query) {
                $query->whereHas('pet', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
            })
            ->paginate(
                perPage: 4,
                pageName: 'currentWeekPage'
            );
    }

    #[Computed]
    public function lastWeekRequests(): LengthAwarePaginator
    {
        $startLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endLastWeek = Carbon::now()->subWeek()->endOfWeek();

        return $this->daycareRequests()
            ->where('start_date', '<=', $endLastWeek)
            ->where('end_date', '>=', $startLastWeek)
            ->when($this->lastWeeksearch, function ($query) {
                $query->whereHas('pet', function ($q) {
                    $q->where('name', 'like', "%{$this->lastWeeksearch}%");
                });
            })
            ->paginate(
                perPage: 4,
                pageName: 'lastWeekPage'
            );
    }

    #[Computed]
    public function lastMonthRequests(): LengthAwarePaginator
    {
        $startLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endLastMonth = Carbon::now()->subMonth()->endOfMonth();

        return $this->daycareRequests()
            ->where('start_date', '<=', $endLastMonth)
            ->where('end_date', '>=', $startLastMonth)
            ->when($this->lastMonthsearch, function ($query) {
                $query->whereHas('pet', function ($q) {
                    $q->where('name', 'like', "%{$this->lastMonthsearch}%");
                });
            })
            ->paginate(
                perPage: 4,
                pageName: 'lastMonthPage'
            );
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


    #[On('open-owner-modal')]
    public function loadOwner($userId): void
    {
        $this->selectedOwner = User::with([
            'pets',
            'pets.breed',
            'pets.animalType',
        ])->findOrFail($userId);
    }

    public function deleteDog($petId)
    {
        $dog = Pet::findOrFail($petId);
        $dog->delete();
        $this->resetPage();
    }
};
?>

<div>
    <div class="ml-25">
        <div>
            <x-dashboard.daycare-table
                title="Chiens présents cette semaine"
                :requests="$this->currentWeekRequests"
            />
        </div>
        <div>
            <x-dashboard.daycareLastWeek-table
                title="Chiens présents la semaine dernière"
                :requests="$this->lastWeekRequests"
            />
        </div>
        <div>
            <x-dashboard.daycareLastMonth-table
                title="Chiens présents le mois dernier"
                :requests="$this->lastMonthRequests"
            />
        </div>
        <x-modale.owner_infos_modale
            :selected-owner="$selectedOwner"
        />
    </div>
</div>
