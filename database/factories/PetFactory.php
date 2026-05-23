<?php

namespace Database\Factories;

use App\Models\AnimalType;
use App\Models\Breed;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition(): array
    {
        $gender = fake()->boolean();

        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'animal_type_id' => AnimalType::inRandomOrder()->first()?->id,
            'breed_id' => Breed::inRandomOrder()->first()?->id,

            'name' => fake()->firstName(),

            'gender' => $gender,

            'birth_date' => fake()->dateTimeBetween('-15 years', '-2 months'),

            'description' => fake()->sentence(12),

            'pet_image' => null,
        ];
    }
}
