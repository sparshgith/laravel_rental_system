<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->address(),
            'property_type' => fake()->randomElement(['Apartment', 'House', 'Studio']),
            'location' => fake()->city(),
            'number_of_rooms' => fake()->numberBetween(1, 5),
            'furnish_status' => fake()->randomElement(['Furnished', 'Unfurnished']),
            'monthly_rent' => fake()->numberBetween(50000, 200000),
            
            // THIS IS THE IMPORTANT LINE
            // We will use a placeholder service that provides real image URLs
            'main_image' => 'https://picsum.photos/seed/' . fake()->unique()->word() . '/400/300',

            'is_occupied' => false,
        ];
    }
}