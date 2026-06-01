@props([
    'title',
    'petsitters',
    'showActions' => false,
])

<section class=" mb-6 md:mt-30 text-text text-2xl uppercase font-bold">

    <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">
        {{ $title }}
    </h2>

</section>

<div>

    <table class="min-w-full border dark:border-none">

        <thead class="bg-element">

        <tr class="bg-background border-b">

            <th class="border-r py-2">
                Nom
            </th>

            <th class="border-r">
                Prénom
            </th>

            <th class="border-r">
                Email
            </th>

            <th class="border-r">
                Téléphone
            </th>

            <th class="border-r">
                Habitation
            </th>

            <th class="border-r">
                Types d'animaux
            </th>

            <th class="border-r">
                Actions
            </th>

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
                    {{ $petsitter->habitation?->name }}
                </x-table.table-data>

                <x-table.table-data>

                    {{ $petsitter->animalTypes
                        ->pluck('type')
                        ->join(', ')
                    }}

                </x-table.table-data>

                <x-table.table-data>

                    @if($showActions)

                        <div class="flex gap-2 items-center justify-center">

                            <x-table.accept-button
                                wire:click="acceptPetsitterRequest({{ $petsitter->id }})"
                            />

                            <x-table.refuse-button
                                wire:click="rejectPetsitterRequest({{ $petsitter->id }})"
                            />

                        </div>

                    @endif

                </x-table.table-data>

            </tr>

        @empty

            <tr>

                <td colspan="7" class="bg-white p-3 text-center">
                    Pas de petsitter trouvés
                </td>

            </tr>
        @endforelse

        </tbody>

    </table>
    <div class="mt-12 flex justify-center">
        {{ $petsitters->links(data: ['scrollTo' => false]) }}
    </div>
</div>
