<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Nos petsitters'])]
class extends Component {
    //
};
?>

<div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste de nos petsitters</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Nom</th>
                <th class="border-r">Prénom</th>
                <th class="border-r">Email</th>
                <th class="border-r">Téléphone</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <x-table.table-data>
                    Royen
                </x-table.table-data>
                <x-table.table-data>
                    Jean
                </x-table.table-data>
                <x-table.table-data>
                    jean@mail.be
                </x-table.table-data>
                <x-table.table-data>
                    04 90 90 90 90
                </x-table.table-data>
                <x-table.table-data>

                </x-table.table-data>
            </tr>

            {{--<tr>
                <td colspan="6" class="bg-white p-3">Pas d’animaux trouvés</td>
            </tr>--}}

            </tbody>
        </table>
        <div class=" flex justify-end mt-6">
            <x-cta.add title="+ Ajouter un petsitter"/>
        </div>
    </div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des demandes de petsitters</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Nom & Prénom</th>
                <th class="border-r">Email</th>
                <th class="border-r">Habitation</th>
                <th class="border-r">Type d'animal</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <x-table.table-data>
                    Sophie Dupont
                </x-table.table-data>
                <x-table.table-data>
                    sophie@mail.be
                </x-table.table-data>
                <x-table.table-data>
                    Maison  avec jardin
                </x-table.table-data>
                <x-table.table-data>
                  Chien
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
