<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 year', '+2 weeks'),
            'group_id' => $this->faker->numberBetween(1, 6),
            'vehicle_id' => $this->faker->randomDigitNotNull,
            'driving_schedule_id' => $this->faker->numberBetween(1, 10),
            'place_id' => $this->faker->numberBetween(1, 9),
            'student' => $this->faker->numberBetween(11, 50),
            'instructor' => $this->faker->numberBetween(6, 10),
            'comment' => $this->faker->sentence(),
        ];
    }
}
