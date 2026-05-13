<?php

namespace Database\Seeders;

use App\enum\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'last_name'=>'Juju',
            'first_name'=>'Julie',
            'email'=>'julie@mail.be',
            'password'=>'julieTest',
            'phone'=>'0499 90 90 91',
            'adress'=>'route de Napoleon 15',
            'zip'=>4550,
            'role'=>UserRole::OWNER
        ]);

        User::create([
            'last_name'=>'clem',
            'first_name'=>'Clement',
            'email'=>'clem@mail.be',
            'password'=>'clemTest',
            'phone'=>'0499 90 90 90',
            'adress'=>'route de Napoleon 150',
            'zip'=>4000,
            'role'=>UserRole::PETSITTER
        ]);

        User::create([
            'last_name'=>'Nono',
            'first_name'=>'Norbert',
            'email'=>'nono@mail.be',
            'password'=>'nonoTest',
            'phone'=>'0499 90 90 92',
            'adress'=>'route de Napoleon 1',
            'zip'=>4400,
            'role'=>UserRole::ADMIN,
        ]);

        DB::table('animal_types')->insert([
            ['type'=>'chien'],
            ['type'=>'chat'],
            ['type'=>'lapin'],
            ['type'=>'furet'],
            ['type'=>'serpent'],
            ['type'=>'hamster'],

    ]);
        DB::table('habitations')->insert([
            ['name'=>'maison'],
            ['name'=>'studio'],
            ['name'=>'appartement'],
            ['name'=>'ferme'],
    ]);
    }
}
