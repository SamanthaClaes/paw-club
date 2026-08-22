<?php

use App\Enums\PetsitterRequestStatus;
use App\Models\PetSittingRequest;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mon planning | Paw-club')]
class extends Component {

    public ?PetSittingRequest $selectedRequest = null;

    public function getEvents(): array
    {
        return PetSittingRequest::with('pet')
            ->where('petsitter_id', Auth::id())
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->get()
            ->map(function ($request) {

                return [
                    'id' => $request->id,
                    'title' => $request->pet?->name ?? 'Animal',
                    'start' => $request->start_date,
                    'end' => Carbon::parse($request->end_date)->addDay()->toDateString(),
                    'backgroundColor' => '#50C878',
                ];
            })
            ->toArray();

    }

    #[On('open-petsitting-event')]
    public function openPetsittingEvent($requestId): void
    {
        $this->selectedRequest = PetSittingRequest::with([
            'pet',
            'pet.animalType',
        ])->findOrFail($requestId);

        $this->dispatch('open-petsitting-modal');
    }

    public function confirmDelete($requestId): void
    {
        $this->dispatch(
            'open-delete-petsitting-modal',
            requestId: $requestId
        );

        $this->dispatch('open-delete-petsitting-modal');
    }

    public function deleteRequest($requestId): void
    {
        $request = PetSittingRequest::where('petsitter_id', Auth::id())
            ->findOrFail($requestId);

        $request->delete();

        $this->selectedRequest = null;

        $this->dispatch('remove-calendar-event', requestId: $requestId);
        $this->dispatch('close-delete-petsitting-modal');
    }

};
?>

<div>
    <x-header.PetsitterNav/>
    <div wire:ignore>
        <div id="calendar" data-events='@json($this->getEvents())' class="max-w-5xl mx-auto mt-20 mb-20">

        </div>
    </div>

    <x-modale.planning_modale
        :selected-request="$selectedRequest"
    />
    <x-modale.delete_event
        :selected-request="$selectedRequest"
    />
</div>
