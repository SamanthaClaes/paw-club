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
        User::create([
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
        $thomas->animalTypes()->attach([1, 2]);

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
    }
}
