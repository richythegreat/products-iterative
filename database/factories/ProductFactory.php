<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'description' => fake()->sentence(10),
            'price' => fake()->randomFloat(2, 5, 500),
            'quantity' => fake()->numberBetween(0, 100),
        ];
    }
}