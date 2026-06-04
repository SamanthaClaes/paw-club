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

                ['name' => 'houseWithGarden'],
                ['name' => 'houseWithoutGarden'],
                ['name' => 'studioWithGardenOrPatio'],
                ['name' => 'studioWithoutOutdoorSpace'],
                ['name' => 'apartmentWithBalcony'],
                ['name' => 'apartmentWithoutOutdoorSpace'],
                ['name' => 'farm'],
        ]);
    }
}
