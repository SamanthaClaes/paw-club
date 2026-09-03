@props([
    'title',
    'petsitters',
])

<section class="mb-6 md:mt-30">
    <h2 class="text-xl mt-6 font-bold text-text dark:text-white md:text-2xl md:mt-20">
        {{ $title }}
    </h2>
</section>

<div class="overflow-hidden rounded-2xl border-2 border-stroke shadow-sm p-5 bg-card dark:bg-blue-950 dark:border-blue-800">

    <flux:table :paginate="$petsitters">

        <flux:table.columns>

            <flux:table.column align="center">
                Photo
            </flux:table.column>

            <flux:table.column align="center">
                Nom
            </flux:table.column>

            <flux:table.column align="center">
                Prénom
            </flux:table.column>

            <flux:table.column align="center">
                Email
            </flux:table.column>

            <flux:table.column align="center">
                Téléphone
            </flux:table.column>

            <flux:table.column align="center">
                Habitation
            </flux:table.column>

            <flux:table.column align="center">
                Types d'animaux
            </flux:table.column>

            <flux:table.column align="center">
                Actions
            </flux:table.column>

        </flux:table.columns>

        <flux:table.rows>

            @forelse($petsitters as $petsitter)

                <flux:table.row>

                    <flux:table.cell align="center">
                        <img
                            src="{{ $petsitter->image ? $petsitter->getImageUrl(400) : asset('img/avatar.jpg') }}"
                            alt="{{ $petsitter->first_name }} {{ $petsitter->last_name }}"
                            class="w-10 h-10 rounded-full object-cover mx-auto"
                        >
                    </flux:table.cell>

                    <flux:table.cell align="center" variant="strong">
                        {{ $petsitter->last_name }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        {{ $petsitter->first_name }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        {{ $petsitter->email }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        {{ $petsitter->phone }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        {{ __('habitationType.' . $petsitter->habitation?->name) }}
                    </flux:table.cell>

                    <flux:table.cell align="center" class="max-w-xs">
                        {{ $petsitter->animalTypes
                            ->map(fn ($animalType) => __('animalTypes.' . $animalType->type))
                            ->join(', ') }}
                    </flux:table.cell>

                    <flux:table.cell align="center">

                        <div class="flex justify-center gap-2">

                            <flux:button
                                variant="primary"
                                size="sm"
                                wire:click="acceptPetsitterRequest({{ $petsitter->id }})"
                                class="bg-btn-green hover:bg-hover-green text-white cursor-pointer"
                            >
                                Accepter
                            </flux:button>

                            <flux:button
                                variant="danger"
                                size="sm"
                                wire:click="rejectPetsitterRequest({{ $petsitter->id }})"
                                class="cursor-pointer"
                            >
                                Refuser
                            </flux:button>

                        </div>

                    </flux:table.cell>

                </flux:table.row>

            @empty

                <flux:table.row>

                    <flux:table.cell colspan="8" class="text-center py-8">
                        Aucun petsitter trouvé.
                    </flux:table.cell>

                </flux:table.row>

            @endforelse

        </flux:table.rows>

    </flux:table>

</div>
