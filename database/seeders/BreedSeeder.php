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
                'name' => 'german_shepherd',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'labrador_retriever',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'golden_retriever',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'border_collie',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'australian_shepherd',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'chihuahua',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'shiba_inu',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'belgian_malinois',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'french_bulldog',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'english_cocker_spaniel',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'beagle',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'poodle',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'jack_russell_terrier',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'siberian_husky',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'rottweiler',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'great_dane',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'maltese',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'bichon_frise',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'yorkshire_terrier',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'akita_inu',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'samoyed',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'newfoundland',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'dachshund',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'dalmatian',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'boxer',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'cane_corso',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'brittany_spaniel',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'cavalier_king_charles_spaniel',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'pomeranian',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'shetland_sheepdog',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'other',
            ],

            // CHATS
            [
                'animal_type_id' => 2,
                'name' => 'maine_coon',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'siamese',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'persian',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'bengal',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'british_shorthair',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'ragdoll',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'birman',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'norwegian_forest_cat',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'sphynx',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'chartreux',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'oriental_shorthair',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'devon_rex',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'cornish_rex',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'abyssinian',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'turkish_angora',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'russian_blue',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'scottish_fold',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'savannah',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'exotic_shorthair',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'burmese',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'other',
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

            // LAPINS
            [
                'animal_type_id' => 3,
                'name' => 'dutch_lop',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'dwarf_rabbit',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'rex_rabbit',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'french_lop',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'flemish_giant',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'lionhead_rabbit',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'english_spot',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'havana_rabbit',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'angora_rabbit',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'californian_rabbit',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'other',
            ],

            // FURETS
            [
                'animal_type_id' => 4,
                'name' => 'champagne_ferret',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'cinnamon_ferret',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'chocolate_ferret',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'silver_ferret',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'panda_ferret',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'other',
            ],

            // SERPENTS

            [
                'animal_type_id' => 5,
                'name' => 'ball_python',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'boa_constrictor',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'corn_snake',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'morelia_python',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'carpet_python',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'corn_snake',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'green_tree_python',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'kingsnake',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'burmese_python',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'rainbow_boa',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'other',
            ],

            // HAMSTERS

            [
                'animal_type_id' => 6,
                'name' => 'syrian_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'russian_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'roborovski_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'chinese_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'campbell_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'winter_white_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'black_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'satin_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'angora_hamster',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'other',
            ],
        ]);
    }
}
