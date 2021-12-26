<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Paper;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
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
            User::factory(10)
                ->sequence(fn () => ['role' => Role::STUDENT])
                ->has(Person::factory()->count(1)
                    ->sequence(
                        fn () => ['date_of_birth' => $faker->dateTimeBetween('-60 years', '-19 years')]
                    )
                    ->has(Paper::factory()->count(1)))
        )->create();
    }
}
