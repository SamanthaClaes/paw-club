<?php

namespace Database\Seeders;

use App\Models\DayCareRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayCareRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DayCareRequest::factory(15)->create();
        DayCareRequest::factory(5)
            ->pending()
            ->create();

        DayCareRequest::factory(5)
            ->currentWeek()
            ->create();

        DayCareRequest::factory(5)
            ->lastWeek()
            ->create();
    }
}
