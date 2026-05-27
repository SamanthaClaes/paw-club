@props([
    'title',
    'requests',
])

<section class="md:ml-25 mb-6">

    <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-20">
        {{ $title }}
    </h2>

</section>

<div class="ml-25">

    <table class="min-w-full border dark:border-none">

        <thead class="bg-element">

        <tr class="bg-background border-b">

            <th class="border-r">Nom</th>

            <th class="border-r">Race</th>

            <th class="border-r">Genre</th>

            <th class="border-r">Date de garde</th>

            <th class="border-r">Fiche du propriétaire</th>

        </tr>

        </thead>

        <tbody>

        @forelse($requests as $request)

            <tr>

                <x-table.table-data>
                    {{ $request->pet?->name }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $request->pet?->breed?->name }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $request->pet?->gender ? 'Mâle' : 'Femelle' }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ Carbon\Carbon::parse($request->start_date)->format('d/m/Y') }}
                    -
                    {{ Carbon\Carbon::parse($request->end_date)->format('d/m/Y') }}
                </x-table.table-data>

                <x-table.table-data>

                    <button
                        wire:click="$dispatch('open-owner-modal', { userId: {{ $request->user->id }} })"
                    >
                        Voir la fiche du propriétaire
                    </button>

                </x-table.table-data>

            </tr>

        @empty

            <tr>

                <td colspan="6" class="bg-white p-3">
                    Pas d’animaux trouvés
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>
