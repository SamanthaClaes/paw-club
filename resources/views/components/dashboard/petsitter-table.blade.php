@php use App\Enums\PetsitterActive; @endphp
@props([
    'title',
    'petsitters',
])

<section class="mb-6 md:mt-30">
    <h2 class="text-xl mt-6 font-bold text-text dark:text-white md:text-2xl md:mt-20">
        {{ $title }}
    </h2>
</section>

<div
    class="overflow-hidden rounded-2xl border-2 border-stroke shadow-sm p-5 bg-card dark:bg-blue-950 dark:border-blue-800">

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

            <flux:table.column>
                Statut
            </flux:table.column>

            <flux:table.column align="end">
                Actions
            </flux:table.column>

        </flux:table.columns>

        <flux:table.rows>

            @forelse($petsitters as $petsitter)

                <flux:table.row>

                    <flux:table.cell variant="strong">
                        <button
                            type="button"
                            wire:click="showPetsitterStats({{ $petsitter->id }})"
                            class="font-bold underline cursor-pointer transition"
                        >
                            {{ $petsitter->last_name }}
                        </button>
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $petsitter->first_name }}
                    </flux:table.cell>

                    <flux:table.cell>
                        <a href="mailto:{{ $petsitter->email }}" class="underline font-bold hover:text-gray-600">
                            {{ $petsitter->email }}
                        </a>
                    </flux:table.cell>

                    <flux:table.cell>
                        <a href="tel:{{ $petsitter->phone }}" class="underline font-bold hover:text-gray-600">
                            {{ $petsitter->phone }}
                        </a>
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ __('habitationType.' . $petsitter->habitation?->name) }}
                    </flux:table.cell>

                    <flux:table.cell>
                        <flux:badge
                            :color="$petsitter->petsitter_active === \App\Enums\PetsitterActive::ACTIVE
            ? 'green'
            : 'zinc'"
                        >
                            {{ $petsitter->petsitter_active === PetsitterActive::ACTIVE
                                ? 'Actif'
                                : 'Inactif' }}
                        </flux:badge>
                    </flux:table.cell>

                    <flux:table.cell>

                        <div class="flex justify-end">

                            <flux:dropdown position="bottom" align="end">

                                <flux:button
                                    variant="ghost"
                                    icon="ellipsis-horizontal"
                                    aria-label="Actions"
                                />

                                <flux:menu>

                                    <flux:menu.item
                                        wire:click="confirmStatusChange({{ $petsitter->id }})"
                                    >
                                        {{ $petsitter->petsitter_active === PetsitterActive::ACTIVE
                                            ? 'Passer en inactif'
                                            : 'Passer en actif' }}
                                    </flux:menu.item>

                                    <flux:menu.separator />

                                    <flux:menu.item
                                        variant="danger"
                                        wire:click="deletePetsitter({{ $petsitter->id }})"
                                        wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $petsitter->first_name }} {{ $petsitter->last_name }} ?"
                                    >
                                        Supprimer
                                    </flux:menu.item>

                                </flux:menu>

                            </flux:dropdown>

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
