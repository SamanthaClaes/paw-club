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

    <div class="mb-6 w-1/2">
        <x-search.search search="search"/>
    </div>

    <flux:table :paginate="$petsitters">

        <flux:table.columns>

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

            <flux:table.column align="end">
                Actions
            </flux:table.column>

        </flux:table.columns>

        <flux:table.rows>

            @forelse($petsitters as $petsitter)

                <flux:table.row>

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

                    <flux:table.cell>

                        <div class="flex justify-end">

                            <flux:button
                                variant="danger"
                                size="sm"
                                wire:click="deletePetsitter({{ $petsitter->id }})"
                                wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $petsitter->first_name }} {{ $petsitter->last_name }} ?"
                            >
                                Supprimer
                            </flux:button>

                        </div>

                    </flux:table.cell>

                </flux:table.row>

            @empty

                <flux:table.row>

                    <flux:table.cell colspan="6" class="text-center py-8">
                        Aucun petsitter trouvé.
                    </flux:table.cell>

                </flux:table.row>

            @endforelse

        </flux:table.rows>

    </flux:table>

</div>
