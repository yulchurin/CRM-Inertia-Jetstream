<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetAddress(),
            'address' => $this->faker->streetAddress(),
            'location' => new Point($this->faker->latitude(), $this->faker->longitude())
        ];
    }
}
