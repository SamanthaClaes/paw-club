<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Nos chiens'])]
class extends Component {
    //
};
?>

<div>
    <section class="md:ml-25 mb-6 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-20 dark:text-white">Chiens présents cette semaine</h2>
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
            <tr>
                <x-table.table-data>
                    Max
                </x-table.table-data>
                <x-table.table-data>
                    Labrador
                </x-table.table-data>
                <x-table.table-data>
                    Mâle
                </x-table.table-data>
                <x-table.table-data>
                    8 juin 2026 - 10 juin 2026
                </x-table.table-data>
                <x-table.table-data>
                    Voir la fiche du propriétaire
                </x-table.table-data>
            </tr>

            {{--<tr>
                <td colspan="6" class="bg-white p-3">Pas d’animaux trouvés</td>
            </tr>--}}

            </tbody>
        </table>
        <div class=" flex justify-end mt-6">
            <x-cta.add title="+ Ajouter un chien"/>
        </div>
    </div>
    <section class="md:ml-25 mb-6 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-20 dark:text-white">Chiens présents la semaine dernière</h2>
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
            <tr>
                <x-table.table-data>
                    Max
                </x-table.table-data>
                <x-table.table-data>
                    Labrador
                </x-table.table-data>
                <x-table.table-data>
                    Mâle
                </x-table.table-data>
                <x-table.table-data>
                    8 juin 2026 - 10 juin 2026
                </x-table.table-data>
                <x-table.table-data>
                    Voir la fiche du propriétaire
                </x-table.table-data>
            </tr>

            {{--<tr>
                <td colspan="6" class="bg-white p-3">Pas d’animaux trouvés</td>
            </tr>--}}

            </tbody>
        </table>
    </div>
    <section class="md:ml-25 mb-6 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-20 dark:text-white">Chiens présents le mois dernier</h2>
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
            <tr>
                <x-table.table-data>
                    Max
                </x-table.table-data>
                <x-table.table-data>
                    Labrador
                </x-table.table-data>
                <x-table.table-data>
                    Mâle
                </x-table.table-data>
                <x-table.table-data>
                    8 juin 2026 - 10 juin 2026
                </x-table.table-data>
                <x-table.table-data>
                    Voir la fiche du propriétaire
                </x-table.table-data>
            </tr>

            {{--<tr>
                <td colspan="6" class="bg-white p-3">Pas d’animaux trouvés</td>
            </tr>--}}

            </tbody>
        </table>
    </div>
</div>
