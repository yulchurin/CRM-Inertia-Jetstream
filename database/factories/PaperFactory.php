<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'series' => $this->faker->numerify('####'),
            'number' => $this->faker->numerify('######'),
            'issuer' => $this->faker->company(),
            'issuance_date' => $this->faker->date(),
            'place_of_birth' => $this->faker->country(),
            'snils' => $this->faker->numerify('###########')
        ];
    }
}
