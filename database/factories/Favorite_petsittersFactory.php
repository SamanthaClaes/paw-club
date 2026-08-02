<?php

namespace Database\Factories;

use App\Models\Favorite_petsitters;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class Favorite_petsittersFactory extends Factory
{
    protected $model = Favorite_petsitters::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
