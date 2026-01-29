<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'price' => fake()->numberBetween(10000, 1000000),
            'stock' => fake()->numberBetween(0, 100),
            'description' => fake()->paragraph(5),
        ];
    }
}