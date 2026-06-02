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
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'phone' => $this->faker->phoneNumber(),
            'adress' => $this->faker->streetAddress(),
            'zip' => $this->faker->numberBetween(1000, 6999),
            'location' => $this->faker->city(),
            'image' => null,
            'habitation_id' => $this->faker->numberBetween(1, 4),
            'role' => null,
            'is_petsitter' => false,
            'price' => $this->faker->randomElement([15, 20, 25]),
        ];
    }

    public function petsitter(): static
{
    return $this->state(fn() => [
        'role' => null,
        'is_petsitter' => true,
        'petsitter_status' => PetsitterStatus::ACCEPTED,
        'description' => $this->faker->paragraph(),
    ]);
}


    public function admin(): static
    {
        return $this->state(fn() => [

            'role' => UserRole::ADMIN,

        ]);
    }
}
