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
    public function definition()
    {
        return [
            'gender' => $this->faker->boolean(),
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->firstNameMale(),
            'date_of_birth' => $this->faker->date(),
            'phone' => $this->faker->e164PhoneNumber(),
            'address_zip' => $this->faker->postcode(),
            'address_region' => $this->faker->country(),
            'address_city' => $this->faker->city(),
            'address_street' => $this->faker->streetAddress(),
            'address_house' => $this->faker->buildingNumber(),
            'address_flat' => $this->faker->buildingNumber(),
        ];
    }
}
