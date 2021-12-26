<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('-2 months');
        return [
            'title' => $this->faker->unique()->randomDigitNotNull,
            'start' => $start,
            'end' => Carbon::parse($start)->addDays(99),
            'base_price' => $this->faker->randomNumber(7),
            'price_per_driving_hour' => $this->faker->randomNumber(5),
        ];
    }
}
