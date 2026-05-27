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
            'last_name' => 'Juju',
            'first_name' => 'Julie',
            'email' => 'julie@mail.be',
            'password' => 'julieTest',
            'phone' => '0499 90 90 91',
            'adress' => 'route de Napoleon 15',
            'zip' => 4550,
            'location' => 'nandrin',
            'habitation_id' => 1,
            'role' => null,
            'is_petsitter'=>false,
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
            'habitation_id' => 2,
            'role' => null,
            'is_petsitter'=>true
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
            'habitation_id' => 3,
            'role' => UserRole::ADMIN,
        ]);
        User::factory(15)->create();
        User::factory(8)
            ->petsitter()
            ->create();
    }
}
