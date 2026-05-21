<?php

use App\Enums\PetsitterRequestStatus;
use App\Models\PetSittingRequest;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mon planning')]
class extends Component {
    public function getEvents(): array
    {
        return PetSittingRequest::with('pet')
            ->where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->get()
            ->map(function ($request) {

                return [
                    'title' => $request->pet->name,
                    'start' => $request->start_date,
                    'end' => \Carbon\Carbon::parse($request->end_date)->addDay()->toDateString(),
                    'backgroundColor' => '#50C878',
                ];
            })
            ->toArray();

    }
};
?>

<div>
    <div wire:ignore>
        <div id="calendar" data-events='@json($this->getEvents())' class="max-w-5xl mx-auto mt-20 mb-20">

        </div>
    </div>
</div>
