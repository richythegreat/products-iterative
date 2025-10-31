<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true), // piem. "Ultra Smart Watch"
            'description' => fake()->paragraph(2), // īss apraksts
            'price' => fake()->randomFloat(2, 5, 500), // cenas robežās 5.00–500.00 €
        ];
    }
}