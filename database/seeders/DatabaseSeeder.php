<?php

namespace Database\Seeders;

use App\enum\UserRole;
use App\Models\DayCareRequest;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('habitations')->insert([
            ['name' => 'maison'],
            ['name' => 'studio'],
            ['name' => 'appartement'],
            ['name' => 'ferme'],
        ]);


        User::create([
            'last_name' => 'Juju',
            'first_name' => 'Julie',
            'email' => 'julie@mail.be',
            'password' => 'julieTest',
            'phone' => '0499 90 90 91',
            'adress' => 'route de Napoleon 15',
            'zip' => 4550,
            'location' => 'nandrin',
            'habitation_id' => '1',
            'role' => UserRole::OWNER
        ]);

        User::create([
            'last_name' => 'clem',
            'first_name' => 'Clement',
            'email' => 'clem@mail.be',
            'password' => 'clemTest',
            'phone' => '0499 90 90 90',
            'adress' => 'route de Napoleon 150',
            'zip' => 4000,
            'location' => 'liege',
            'habitation_id' => '2',
            'role' => UserRole::PETSITTER
        ]);

        User::create([
            'last_name' => 'Nono',
            'first_name' => 'Norbert',
            'email' => 'nono@mail.be',
            'password' => 'nonoTest',
            'phone' => '0499 90 90 92',
            'adress' => 'route de Napoleon 1',
            'zip' => 4400,
            'location' => 'flemalle',
            'habitation_id' => '3',
            'role' => UserRole::ADMIN,
        ]);

        DB::table('animal_types')->insert([
            ['type' => 'chien'],
            ['type' => 'chat'],
            ['type' => 'lapin'],
            ['type' => 'furet'],
            ['type' => 'serpent'],
            ['type' => 'hamster'],
        ]);

        DB::table('breeds')->insert([

            // CHIENS
            [
                'animal_type_id' => 1,
                'name' => 'Berger Allemand',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Labrador Retriever',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Golden Retriever',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Border Collie',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Berger Australien',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Chihuahua',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Shiba Inu',
            ],

            // CHATS
            [
                'animal_type_id' => 2,
                'name' => 'Maine Coon',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Siamois',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Persan',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Bengal',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'British Shorthair',
            ],

            // LAPINS
            [
                'animal_type_id' => 3,
                'name' => 'Bélier Hollandais',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Lapin Nain',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Rex',
            ],

            // FURETS
            [
                'animal_type_id' => 4,
                'name' => 'Furet Albinos',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'Furet Putoisé',
            ],

            // SERPENTS
            [
                'animal_type_id' => 5,
                'name' => 'Python Royal',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Boa Constrictor',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Couleuvre des Blés',
            ],

            // HAMSTERS
            [
                'animal_type_id' => 6,
                'name' => 'Hamster Syrien',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'Hamster Russe',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'Hamster Roborovski',
            ],
        ]);

        DB::table('visit_types')->insert([
            ['name' => 'ponctuelle'],
            ['name' => 'à domicile'],
            ['name' => 'chez le propriétaire'],
            ['name' => 'toutes les visites'],
        ]);
            }

}
