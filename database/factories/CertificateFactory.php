<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numerify('FAKE############'),
            'final_grade' => $this->faker->numberBetween(3, 5),
        ];
    }
}
