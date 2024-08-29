<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieEntity>
 */
class MovieEntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'genre' => $this->faker->randomElement([
                'ACTION', 'ADVENTURE', 'COMEDY', 'DRAMA', 'FANTASY', 'HORROR',
                'MUSICALS', 'MYSTERY', 'ROMANCE', 'SCIENCE_FICTION', 'SPORTS',
                'THRILLER', 'WESTERN'
            ]),
            'allowed_age' => $this->faker->numberBetween(7, 18),
            'length_minutes' => $this->faker->numberBetween(80, 180),
            'status' => $this->faker->boolean,
        ];
    }
}
