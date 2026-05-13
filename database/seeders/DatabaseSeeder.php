<?php

namespace Database\Seeders;

use App\enum\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name'=>'Julie',
            'email'=>'julie@mail.be',
            'password'=>'julieTest',
            'phone'=>'0499 90 90 91',
            'adress'=>'route de Napoleon 15',
            'role'=>UserRole::OWNER
        ]);

        User::create([
            'name'=>'Clement',
            'email'=>'clem@mail.be',
            'password'=>'clemTest',
            'phone'=>'0499 90 90 90',
            'adress'=>'route de Napoleon 150',
            'role'=>UserRole::PETSITTER
        ]);

        User::create([
            'name'=>'Norbert',
            'email'=>'nono@mail.be',
            'password'=>'nonoTest',
            'phone'=>'0499 90 90 92',
            'adress'=>'route de Napoleon 1',
            'role'=>UserRole::ADMIN,
        ]);
    }
}
