<?php

namespace Database\Factories;

use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new Fakecar($this->faker));
        return [
            'model' => $this->faker->vehicle,
            'number' => $this->faker->randomLetter()
                . $this->faker->numerify('###')
                . $this->faker->randomLetter()
                . $this->faker->randomLetter()
                . $this->faker->randomLetter()
                . $this->faker->numerify('###'),
            'color' => $this->faker->colorName(),
        ];
    }
}
