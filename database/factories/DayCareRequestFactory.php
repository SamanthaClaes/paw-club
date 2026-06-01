<?php

namespace Database\Factories;

use App\Enums\DayCareRequestStatus;
use App\Models\DayCareRequest;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DayCareRequest>
 */
class DayCareRequestFactory extends Factory
{
    protected $model = DayCareRequest::class;

    public function definition(): array
    {
        $startDate = now()->addDays(rand(1, 30));

        $endDate = (clone $startDate)->addDays(rand(1, 10));

        $pet = Pet::where('animal_type_id', 1)
            ->inRandomOrder()
            ->firstOrFail();

        return [

            'user_id' => $pet->user_id,

            'pet_id' => $pet->id,

            'image' => null,

            'infos' => fake()->sentence(10),

            'start_date' => $startDate,

            'end_date' => $endDate,

            'status' => DayCareRequestStatus::ACCEPTED,

        ];
    }

    public function currentWeek(): static
    {
        $startDate = now()->startOfWeek()->addDays(rand(0, 6));
        $endDate = (clone $startDate)->addDays(rand(1, 3));

        return $this->state(fn () => [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    public function lastWeek(): static
    {
        $startDate = now()->subWeek()->startOfWeek()->addDays(rand(0, 6));
        $endDate = (clone $startDate)->addDays(rand(1, 3));

        return $this->state(fn () => [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    public function lastMonth(): static
    {
        $startDate = now()->subMonth()->startOfMonth()->addDays(rand(0, 20));
        $endDate = (clone $startDate)->addDays(rand(1, 5));

        return $this->state(fn () => [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}
