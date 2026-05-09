<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Demandes de garde'])]
class extends Component {
    //
};
?>

<div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des demandes de garde</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Animal</th>
                <th class="border-r">Infos du propriétaire</th>
                <th class="border-r">Dates</th>
                <th class="border-r">Infos de l'animal</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <x-table.table-data>
                    Max (labrador)
                </x-table.table-data>
                <x-table.table-data>
                    Sophie Dupont
                    sophie@mail.be
                </x-table.table-data>
                <x-table.table-data>
                 2 juin - 4 juin 2026
                </x-table.table-data>
                <x-table.table-data>
                    Curieux, calme
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

            {{--<tr>
                <td colspan="6" class="bg-white p-3">Pas d’animaux trouvés</td>
            </tr>--}}

            </tbody>
        </table>
    </div>
</div>
