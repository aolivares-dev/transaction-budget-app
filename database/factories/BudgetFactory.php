<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Budget;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->word(),
            'name' => fake()->name(),
            'total_amount' => fake()->randomFloat(4, 0, 999999.9999),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
        ];
    }
}
