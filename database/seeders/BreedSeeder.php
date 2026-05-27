<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
