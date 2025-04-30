<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BudgetCategory;

class BudgetCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BudgetCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'budget_id' => fake()->word(),
            'category_id' => fake()->word(),
            'budgeted_amount' => fake()->randomFloat(4, 0, 999999.9999),
        ];
    }
}
