<section class="md:ml-25 mb-6">

    <h2 class="text-xl mt-6 font-bold text-text dark:text-white md:text-2xl md:mt-20">
        {{ $title }}
    </h2>

</section>

<div class="ml-25">

    <div class="w-1/2 mb-6">
        <x-search.search search="lastWeeksearch" />
    </div>

    <div class="overflow-hidden rounded-2xl border-2 border-stroke shadow-sm p-5 bg-card dark:bg-blue-950 dark:border-blue-800">

        <flux:table :paginate="$requests">

            <flux:table.columns>

                <flux:table.column
                    sortable
                    wire:click="sortLastWeek('pet_name')"
                >
                    Nom
                </flux:table.column>

                <flux:table.column>
                    Race
                </flux:table.column>

                <flux:table.column>
                    Genre
                </flux:table.column>

                <flux:table.column>
                    Date de garde
                </flux:table.column>

                <flux:table.column>
                    Propriétaire
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse($requests as $request)

                    <flux:table.row>

                        <flux:table.cell variant="strong">
                            {{ $request->pet?->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $request->pet?->breed?->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $request->pet?->gender ? 'Mâle' : 'Femelle' }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ \Carbon\Carbon::parse($request->start_date)->format('d/m/Y') }}
                            -
                            {{ \Carbon\Carbon::parse($request->end_date)->format('d/m/Y') }}
                        </flux:table.cell>

                        <flux:table.cell>

                            <flux:button
                                variant="ghost"
                                size="sm"
                                wire:click="$dispatch('open-owner-modal', { userId: {{ $request->user->id }} })"
                            >
                                Voir la fiche
                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="5" class="text-center py-8">
                            Pas d'animaux trouvés.
                        </flux:table.cell>

                    </flux:table.row>

                @endforelse

            </flux:table.rows>

        </flux:table>

    </div>

</div>
