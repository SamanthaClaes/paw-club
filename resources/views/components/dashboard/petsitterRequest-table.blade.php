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

            <flux:table.column>
                Photo
            </flux:table.column>

            <flux:table.column>
                Nom
            </flux:table.column>

            <flux:table.column>
                Prénom
            </flux:table.column>

            <flux:table.column>
                Email
            </flux:table.column>

            <flux:table.column>
                Téléphone
            </flux:table.column>

            <flux:table.column>
                Habitation
            </flux:table.column>

            <flux:table.column>
                Types d'animaux
            </flux:table.column>

            <flux:table.column align="end">
                Actions
            </flux:table.column>

        </flux:table.columns>

        <flux:table.rows>

            @forelse($petsitters as $petsitter)

                <flux:table.row>

                    <flux:table.cell>
                        <img
                            src="{{ $petsitter->image ? $petsitter->getImageUrl(400) : asset('img/avatar.jpg') }}"
                            alt="{{ $petsitter->first_name }} {{ $petsitter->last_name }}"
                            class="w-10 h-10 rounded-full object-cover"
                        >
                    </flux:table.cell>

                    <flux:table.cell variant="strong">
                        {{ $petsitter->last_name }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $petsitter->first_name }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $petsitter->email }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $petsitter->phone }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ __('habitationType.' . $petsitter->habitation?->name) }}
                    </flux:table.cell>

                    <flux:table.cell class="max-w-xs">
                        {{ $petsitter->animalTypes
                            ->map(fn ($animalType) => __('animalTypes.' . $animalType->type))
                            ->join(', ') }}
                    </flux:table.cell>

                    <flux:table.cell>

                        <div class="flex justify-end gap-2">

                            <flux:button
                                variant="primary"
                                size="sm"
                                wire:click="acceptPetsitterRequest({{ $petsitter->id }})"
                                class="bg-btn-green hover:bg-hover-green text-white"
                            >
                                Accepter
                            </flux:button>

                            <flux:button
                                variant="danger"
                                size="sm"
                                wire:click="rejectPetsitterRequest({{ $petsitter->id }})"
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
