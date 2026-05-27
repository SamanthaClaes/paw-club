<?php

namespace Database\Factories;

use App\Enum\UserRole;
use App\Enums\PetsitterStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [

            'last_name' => fake()->lastName(),

            'first_name' => fake()->firstName(),

            'email' => fake()->unique()->safeEmail(),

            'password' => Hash::make('password'),

            'phone' => fake()->phoneNumber(),

            'adress' => fake()->streetAddress(),

            'zip' => fake()->numberBetween(1000, 6999),

            'location' => fake()->city(),

            'habitation_id' => fake()->numberBetween(1, 4),

            'role' => null,

            'is_petsitter' => false,

        ];
    }

    public function petsitter(): static
    {
        return $this->state(fn () => [

            'role' => null,
            'is_petsitter' => true,

            'petsitter_status' => PetsitterStatus::ACCEPTED,

            'description' => fake()->paragraph(),

        ]);
    }

    public function admin(): static
    {
        return $this->state(fn () => [

            'role' => UserRole::ADMIN,

        ]);
    }
}
