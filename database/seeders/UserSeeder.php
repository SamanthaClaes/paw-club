<?php

namespace Database\Seeders;

use App\enum\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $sophie =   User::create([
            'last_name' => 'Dubois',
            'first_name' => 'Sophie',
            'email' => 'sophie.dubois@example.be',
            'password' => 'password',
            'phone' => '+32 472 15 84 93',
            'adress' => 'Rue de la Station 24',
            'zip' => 5000,
            'location' => 'Namur',
            'habitation_id' => 1,
            'role' => null,
            'is_petsitter'=>false,
            'image' => null,

        ]);

      $thomas =  User::create([
            'last_name' => 'Lambert',
            'first_name' => 'Thomas',
            'email' => 'thomas.lambert@example.be',
            'password' => 'password',
            'phone' => '+32 478 62 31 47',
            'adress' => 'Avenue des Tilleuls 87',
            'zip' => 4000,
            'location' => 'Liège',
            'habitation_id' => 2,
            'role' => null,
            'is_petsitter'=>true,
            'image' => null,
        ]);
        $thomas->pets()->create([
            'name' => 'Milo',
            'birth_date' => '2021-08-21',
            'gender' => true,
            'description' => 'Très joueur et aime les promenades.',
            'breed_id' => 3,
            'animal_type_id' => 1,
        ]);

        User::create([
            'last_name' => 'Delcourt',
            'first_name' => 'Julien',
            'email' => 'admin@pawclub.be',
            'password' => 'adminpassword',
            'adress' => 'Rue Royale 1',
            'zip' => 1000,
            'location' => 'Bruxelles',
            'role' => UserRole::ADMIN,
        ]);

        User::factory(5)->create();
        User::factory(24)
            ->petsitter()
            ->create()
            ->each(function ($petsitter) {
                $petsitter->animalTypes()->attach(
                    fake()->randomElements(
                        range(1, 6),
                        rand(1, 3)
                    )
                );
            });
        $sophie->pets()->create([
            'name' => 'Max',
            'birth_date' => '2020-05-12',
            'gender' => true,
            'description' => 'Chien calme et sociable.',
            'breed_id' => 5,
            'animal_type_id' => 1,
        ]);
    }

}
