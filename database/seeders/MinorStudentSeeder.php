<?php

namespace Database\Seeders;

use App\Models\LegalRepresentative;
use App\Models\Paper;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class MinorStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        User::factory(5)
            ->has(Person::factory(1)
                ->sequence(fn () => [
                    'date_of_birth' => $faker->dateTimeBetween('-17 years', '-16 years')
                ])
                ->has(Paper::factory(1)))
            ->has(LegalRepresentative::factory(1)
                ->has(Person::factory(1)
                    ->sequence(fn () => [
                        'date_of_birth' => $faker->dateTimeBetween('-60 years', '-34 years')
                    ])
                    ->has(Paper::factory()->count(1)))
            )
            ->create(['role' => Role::STUDENT]);
    }
}
