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
            'name' => fake()->word(),
            'description' => fake()->paragraph(2),
            'price' => fake()->numberBetween(1, 1000000),
            'expiration_date' => now()->addDays(fake()->numberBetween(0, 1)),
            'image_url' => fake()->imageUrl(640, 480, 'animals', true)
        ];
    }
}
