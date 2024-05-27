<?php

namespace Database\Factories;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
{
    protected $model = Goal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'target_amount' => $this->faker->numberBetween(10000, 50000),
            'current_amount' => $this->faker->numberBetween(1000, 9000),
            'target_date' => $this->faker->date,
            'user_id' => User::factory(),
        ];
    }
}
