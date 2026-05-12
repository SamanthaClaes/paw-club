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
            'role'=>UserRole::OWNER
        ]);

        User::create([
            'name'=>'Clement',
            'email'=>'clem@mail.be',
            'password'=>'clemTest',
            'role'=>UserRole::PETSITTER
        ]);

        User::create([
            'name'=>'Norbert',
            'email'=>'nono@mail.be',
            'password'=>'nonoTest',
            'role'=>UserRole::ADMIN,
        ]);
    }
}
