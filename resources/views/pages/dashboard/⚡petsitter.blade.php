<?php

use App\enum\UserRole;
use App\Enums\PetsitterStatus;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Nos petsitters'])]
class extends Component {

    public $petsitters;
    public $petsitterRequests;

    public function mount()
    {
        $this->petsitters = User::where('role', UserRole::PETSITTER)
            ->where('petsitter_status', PetsitterStatus::ACCEPTED)
            ->get();

        $this->loadingPendingRequest();
    }

    public function loadingPendingRequest(): void
    {
        $this->petsitterRequests = User::where('role', UserRole::PETSITTER)
            ->where('petsitter_status', PetsitterStatus::PENDING)
            ->with([
                'habitation',
                'animalTypes',
            ])
            ->get();
    }

    public function acceptPetsitterRequest($requestId): void
    {
        $petsitter = User::findOrFail($requestId);
        $petsitter->petsitter_status = PetsitterStatus::ACCEPTED;
        $petsitter->save();
        $this->loadingPendingRequest();
        $petsitter->refresh();
    }
    public function rejectPetsitterRequest($requestId): void
    {
        $petsitter = User::findOrFail($requestId);

        $petsitter->petsitter_status = PetsitterStatus::REFUSED;

        $petsitter->save();

        $this->loadingPendingRequest();

        $petsitter->refresh();
    }

};
?>

<div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste de nos petsitters</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Nom</th>
                <th class="border-r">Prénom</th>
                <th class="border-r">Email</th>
                <th class="border-r">Téléphone</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($petsitters as $petsitter)
                <tr>
                    <x-table.table-data>
                        {{ $petsitter->last_name }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $petsitter->first_name }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $petsitter->email }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $petsitter->phone }}
                    </x-table.table-data>
                    <x-table.table-data>

                    </x-table.table-data>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="bg-white p-3">Pas de petsitter trouvés</td>
                </tr>
            @endforelse

            </tbody>
        </table>
        <div class=" flex justify-end mt-6">
            <x-cta.add title="+ Ajouter un petsitter"/>
        </div>
    </div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des demandes de
            petsitters</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Nom & Prénom</th>
                <th class="border-r">Email</th>
                <th class="border-r">Habitation</th>
                <th class="border-r">Type d'animal</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($petsitterRequests as $petsitter)
                <tr>
                    <x-table.table-data>
                        {{ $petsitter->first_name }} - {{ $petsitter->last_name }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $petsitter->email }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $petsitter->habitation->name }}
                    </x-table.table-data>
                    <x-table.table-data>
                       @foreach($petsitter->animalTypes as $animalType)
                           {{ $animalType->type }}
                       @endforeach
                    </x-table.table-data>
                    <x-table.table-data>
                        <div class="flex gap-2 items-center justify-center">
                            <div>
                                <x-table.accept-button/>
                            </div>
                            <div>
                                <x-table.refuse-button/>
                            </div>
                        </div>
                    </x-table.table-data>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="bg-white p-3">Pas de petsitter trouvés</td>
                </tr>

            @endforelse
            </tbody>
        </table>
    </div>
</div>
