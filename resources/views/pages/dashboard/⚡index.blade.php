<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title'=>'Dashboard'])]
class extends Component {
    //
};
?>

<div>
    <div class=" md:ml-25 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <x-cards.dashboard_card :number="2" title="Chiens présents"
                                    route=""/>
        </div>
        <div>
            <x-cards.dashboard_card :number="3" title="Demandes non traitées"
                                    route=""/>
        </div>
        <div>
            <x-cards.dashboard_card :number="4" title="Messages non lus"
                                    route=""/>
        </div>
    </div>
    <div>

    </div>
    <section class="md:ml-25 mb-6 text-text text-2xl uppercase font-bold">
            <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Chiens présents cette semaine</h2>
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
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Chiens présents la semaine dernière</h2>
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
