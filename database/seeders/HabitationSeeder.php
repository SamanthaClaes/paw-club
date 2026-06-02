<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('habitations')->insert([
            ['name' => 'maison avec jardin'],
            ['name' => 'maison sans jardin'],
            ['name' => 'studio avec jardin/cour'],
            ['name' => 'studio sans extérieur'],
            ['name' => 'appartement avec balcon'],
            ['name' => 'appartement sans extérieur'],
            ['name' => 'ferme'],
        ]);
    }
}
