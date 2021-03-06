<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'gender' => $this->faker->boolean(),
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->firstNameMale(),
            'date_of_birth' => $this->faker->dateTimeBetween('-70 years', '-17 years'),
            'phone' => $this->faker->numerify('999#######'),
            'zip' => $this->faker->postcode(),
            'region' => $this->faker->country(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetAddress(),
            'house' => $this->faker->buildingNumber(),
            'flat' => $this->faker->buildingNumber(),
        ];
    }
}
