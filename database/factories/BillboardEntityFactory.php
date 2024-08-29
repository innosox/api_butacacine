<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillboardEntity>
 */
class BillboardEntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time,
            'movie_id' => \App\Models\MovieEntity::factory(),
            'room_id' => \App\Models\RoomEntity::factory(),
            'status' => $this->faker->boolean,
        ];
    }
}
