<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'short_name' => $this->faker->companySuffix(),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->companyEmail(),
            'zip' => $this->faker->postcode(),
            'region' => $this->faker->country(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
            'house' => $this->faker->buildingNumber(),
            'office' => $this->faker->buildingNumber(),
            'OGRN' => $this->faker->numerify('#############'),
            'INN' => $this->faker->numerify('##########'),
            'KPP' => $this->faker->numerify('#########'),
            'bank_BIC' => $this->faker->numerify('#########'),
            'bank_name' => $this->faker->company(),
            'bank_account' => $this->faker->numerify('40702810############'),
            'bank_corr_account' => $this->faker->numerify('40702810############'),
            'manager_post' => $this->faker->jobTitle(),
            'manager_first_name' => $this->faker->firstName(),
            'manager_last_name' => $this->faker->lastName(),
            'manager_middle_name' => $this->faker->firstNameMale(),
            'license_issuer' => $this->faker->company(),
            'license_number' => $this->faker->numerify('#####'),
            'license_blank_series' => $this->faker->numerify('##L##'),
            'license_blank_number' => $this->faker->numerify('№#######'),
            'license_issuance_date' => $this->faker->date(),
        ];
    }
}
