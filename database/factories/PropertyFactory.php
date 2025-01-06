<?php

namespace Database\Factories;

use App\Models\PropertyTags;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'owner_id' => 1,
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'tags' => $this->faker->randomElement(['stan', 'centar', 'luksuzan']),
            'area' => $this->faker->numberBetween(30, 200),
            'floors' => $this->faker->numberBetween(1, 20),
            'current_floor' => $this->faker->numberBetween(1, 20),
            'heating' => $this->faker->randomElement(['Centralno', 'Struja', 'Gas', 'Nema']),
            'monthly_utilities' => $this->faker->numberBetween(50, 500),
            'type'=>$this->faker->randomElement(['Stan', 'Soba']),
            'property_type'=>$this->faker->randomElement(['Jednosoban', 'Dvosoban', 'Trosoban', '4+ soba', 'Jednokrevetna', 'Dvokrevetna', 'Trokrevetna']),
            'rent_price' => $this->faker->numberBetween(300, 1500),
        ];
    }

    /**
     * Define a state to add random tags to the property.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withTags(): self
    {
        return $this->afterCreating(function ($property) {
            $tags = PropertyTags::inRandomOrder()->take(3)->pluck('id'); // Select 3 random tags
            $property->tags()->sync($tags); // Assuming you have a many-to-many relationship with tags
        });
    }
}
