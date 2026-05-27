<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visit_types')->insert([
            ['name' => 'ponctuelle'],
            ['name' => 'à domicile'],
            ['name' => 'chez le propriétaire'],
            ['name' => 'toutes les visites'],
        ]);
    }
}
