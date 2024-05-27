<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    protected $model = Currency::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currencies = [
            ['name' => 'United States Dollar', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'Philippine Peso', 'code' => 'PHP', 'symbol' => '₱'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'British Pound Sterling', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥'],
        ];

        return $this->faker->randomElement($currencies);
    }
}
