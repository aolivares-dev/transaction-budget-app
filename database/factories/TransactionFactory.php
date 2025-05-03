<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Transaction;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->word(),
            'type' => fake()->randomElement(["income","expense"]),
            'amount' => fake()->randomFloat(4, 0, 999999.9999),
            'category_id' => fake()->word(),
            'subcategory_id' => fake()->word(),
            'transaction_date' => fake()->date(),
            'description' => fake()->text(),
        ];
    }
}
