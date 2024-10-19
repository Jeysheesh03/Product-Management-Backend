<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Malabanannn
            'barcode' => fake()->numberBetween(100000, 999999),
            'product_name' => fake()->name(),
            'description' => fake()->text(100),
            'price' => fake()->numberBetween(100, 1000),
            'quantity' => fake()->numberBetween(1, 100),
            'category' => fake()->word(),
        ];
    }
}
