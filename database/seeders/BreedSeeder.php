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
            [
                'animal_type_id' => 1,
                'name' => 'Berger Belge Malinois',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Bouledogue Français',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Cocker Anglais',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Beagle',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Caniche',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Jack Russell Terrier',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Husky Sibérien',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Rottweiler',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Dogue Allemand',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Bichon Maltais',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Bichon Frisé',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Yorkshire Terrier',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Akita Inu',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Samoyède',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Terre-Neuve',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Teckel',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Dalmatien',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Boxer',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Cane Corso',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Épagneul Breton',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Cavalier King Charles',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Spitz nain',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Berger des shetlands',
            ],
            [
                'animal_type_id' => 1,
                'name' => 'Autre',
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
            [
                'animal_type_id' => 2,
                'name' => 'Ragdoll',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Sacré de Birmanie',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Norvégien',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Sphynx',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Chartreux',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Oriental',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Devon Rex',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Cornish Rex',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Abyssin',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Angora Turc',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Bleu Russe',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Scottish Fold',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Savannah',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Exotic Shorthair',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Burmese',
            ],
            [
                'animal_type_id' => 2,
                'name' => 'Autre',
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
            [
                'animal_type_id' => 3,
                'name' => 'Bélier Français',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Géant des Flandres',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Tête de Lion',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Papillon',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Havana',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Angora',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Californien',
            ],
            [
                'animal_type_id' => 3,
                'name' => 'Autre',
            ],
            // FURETS

            [
                'animal_type_id' => 4,
                'name' => 'Furet Champagne',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'Furet Cannelle',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'Furet Chocolat',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'Furet Silver',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'Furet Panda',
            ],
            [
                'animal_type_id' => 4,
                'name' => 'Autre',
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
            [
                'animal_type_id' => 5,
                'name' => 'Python Morelia',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Python Tapis',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Serpent des Blés',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Python Vert',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Couleuvre Royale',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Python de Birmanie',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Boa Arc-en-ciel',
            ],
            [
                'animal_type_id' => 5,
                'name' => 'Autre',
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
            [
                'animal_type_id' => 6,
                'name' => 'Hamster Chinois',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'Hamster de Campbell',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'Hamster de Winter White',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'Hamster Noir',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'Hamster Satin',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'Hamster Angora',
            ],
            [
                'animal_type_id' => 6,
                'name' => 'Autre',
            ],
        ]);
    }
}
