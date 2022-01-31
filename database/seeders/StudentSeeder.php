<?php

namespace Database\Seeders;

use App\Interfaces\UserRole;
use App\Models\Group;
use App\Models\Paper;
use App\Models\Person;
use App\Models\Student;
use Faker\Factory;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Group::factory(4)->has(
            Student::factory(10)
                ->sequence(fn () => ['role' => UserRole::STUDENT])
                ->has(Person::factory()->count(1)
                    ->sequence(
                        fn () => ['date_of_birth' => $faker->dateTimeBetween('-60 years', '-19 years')]
                    )
                    ->has(Paper::factory()->count(1)))
        )->create();
    }
}
