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
            'last_name' => 'Claes',
            'first_name' => 'Samantha',
            'email' => 'samantha@mail.be',
            'password' => 'password',
            'phone' => '0496789303',
            'adress' => 'Rue des Cahottes 66',
            'zip' => 4400,
            'location' => 'flémalle',
            'habitation_id' => 1,
            'role' => null,
            'is_petsitter'=>false,
            'image' => 'owner/me.jpeg',

        ]);

      $jean =  User::create([
            'last_name' => 'Royen',
            'first_name' => 'Jean',
            'email' => 'jean@mail.be',
            'password' => 'password',
            'phone' => '0471420854',
            'adress' => 'Rue des Cahottes 66',
            'zip' => 4400,
            'location' => 'flémalle',
            'habitation_id' => 2,
            'role' => null,
            'is_petsitter'=>true,
            'image' => 'owner/ps_1.jpeg'
        ]);
        $jean->animalTypes()->attach([1, 2]);
        User::create([
            'last_name' => 'Dubois',
            'first_name' => 'Norbert',
            'email' => 'nono@mail.be',
            'password' => 'nonoTest',
            'phone' => '0499 90 90 92',
            'adress' => 'route de Napoleon 1',
            'zip' => 4400,
            'location' => 'flemalle',
            'habitation_id' => 3,
            'role' => UserRole::ADMIN,
        ]);
        User::factory(15)->create();
        User::factory(8)
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
