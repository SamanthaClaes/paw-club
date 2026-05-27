<?php

namespace Database\Seeders;

use App\enum\UserRole;
use App\Models\DayCareRequest;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            HabitationSeeder::class,
            AnimalTypeSeeder::class,
            BreedSeeder::class,
            VisitTypeSeeder::class,
            UserSeeder::class,
            PetSeeder::class,
            DayCareRequestSeeder::class,
        ]);











    }

}
