<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $startTime = now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 1) ? 0 : 30, 0);
        $endTime = (clone $startTime)->addHours(rand(1, 3));

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'capacity' => $this->faker->numberBetween(10, 100),
        ];
    }
}