<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Liste de messages'])]
class extends Component {
    //
};
?>

<div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des messages non lus</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Nom </th>
                <th class="border-r">Prénom</th>
                <th class="border-r">Email</th>
                <th class="border-r">Message</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <x-table.table-data>
                     Dupont
                </x-table.table-data>
                <x-table.table-data>
                    Sophie
                </x-table.table-data>
                <x-table.table-data>
                    sophie@mail.be
                </x-table.table-data>
                <x-table.table-data>
                    contenu du message
                </x-table.table-data>
                <x-table.table-data>
                    <div class="flex gap-2 justify-center">
                        <div>
                            <x-table.mail-button/>
                        </div>
                        <div>
                            <x-table.delete-button/>
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
