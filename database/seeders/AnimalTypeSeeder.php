<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('animal_types')->insert([
            ['type' => 'dog'],
            ['type' => 'cat'],
            ['type' => 'rabbit'],
            ['type' => 'ferret'],
            ['type' => 'snake'],
            ['type' => 'hamster'],
            ['type' => 'all'],
        ]);
    }
}
