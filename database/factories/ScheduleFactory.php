<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start' => $this->faker->time(),
            'duration' => $this->faker->randomElement([2700, 3600, 5400, 7200]), // 45 min, 1 hour, 1.5 hours, 2 hours
        ];
    }
}
