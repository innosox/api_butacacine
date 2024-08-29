<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeatEntity>
 */
class SeatEntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->numberBetween(1, 100),
            'row_number' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->boolean,
            'room_id' => \App\Models\RoomEntity::factory(),
        ];
    }
}
