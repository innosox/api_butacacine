<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingEntity>
 */
class BookingEntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTime,
            'status' => true,
            'customer_id' => \App\Models\CustomerEntity::factory(),
            'seat_id' => \App\Models\SeatEntity::factory(),
            'billboard_id' => \App\Models\BillboardEntity::factory(),
        ];
    }
}
