<?php

use App\Enums\DayCareRequestStatus;
use App\Models\DayCareRequest;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Carbon\Carbon;

new #[Layout('layouts::dashboard', ['title' => 'Nos chiens'])]
class extends Component {
    public $lastWeekRequests = [];
    public $lastMonthRequests = [];
    public $currentWeekRequests = [];
    public $selectedOwner = null;


    public function mount(): void
    {
        $startLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $startCurrentWeek = Carbon::now()->startOfWeek();
        $endCurrentWeek = Carbon::now()->endOfWeek();

        $startLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $this->currentWeekRequests = $this->daycareRequests()
            ->where('start_date', '<=', $endCurrentWeek)
            ->where('end_date', '>=', $startCurrentWeek)
            ->get();

        $this->lastWeekRequests = $this->daycareRequests()
            ->where('start_date', '<=', $endLastWeek)
            ->where('end_date', '>=', $startLastWeek)
            ->get();

        $this->lastMonthRequests = $this->daycareRequests()
            ->where('start_date', '<=', $endLastMonth)
            ->where('end_date', '>=', $startLastMonth)
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

    #[On('open-owner-modal')]
    public function loadOwner($userId): void
    {
        $this->selectedOwner = User::with([
            'pets',
            'pets.breed',
            'pets.animalType',
        ])->findOrFail($userId);
    }
};
?>

<div>
    <div class="ml-25">
        <div>
            <x-dashboard.daycare-table
                title="Chiens présents cette semaine"
                :requests="$currentWeekRequests"
            />
        </div>
        <div>
            <x-dashboard.daycare-table
                title="Chiens présents la semaine dernière"
                :requests="$lastWeekRequests"
            />
        </div>
        <div>
            <x-dashboard.daycare-table
                title="Chiens présents le mois dernier"
                :requests="$lastMonthRequests"
            />
        </div>
        <x-modale.owner_infos_modale
            :selected-owner="$selectedOwner"
        />
    </div>
</div>
