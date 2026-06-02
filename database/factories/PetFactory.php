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
        $animalType = AnimalType::inRandomOrder()->first();

        $breed = Breed::where('animal_type_id', $animalType->id)
            ->inRandomOrder()
            ->first();

        return [

            'user_id' => User::inRandomOrder()->first()?->id,

            'animal_type_id' => $animalType->id,

            'breed_id' => $breed?->id,

            'name' => $this->faker->firstName(),

            'gender' => $this->faker->boolean(),

            'birth_date' => $this->faker->dateTimeBetween('-15 years', '-2 months'),

            'description' => $this->faker->sentence(12),

            'pet_image' => null,

        ];
    }
}
