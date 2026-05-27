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
            ['name' => 'maison'],
            ['name' => 'studio'],
            ['name' => 'appartement'],
            ['name' => 'ferme'],
        ]);
    }
}
