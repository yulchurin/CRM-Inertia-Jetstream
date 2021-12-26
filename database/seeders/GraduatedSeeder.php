<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Group;
use App\Models\Paper;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GraduatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $start = $faker->dateTimeBetween('-3 years', '-1 year');

        Group::factory(1)->create([
            'start' => $start,
            'end' => Carbon::parse($start)->addDays(99),
        ]);

        $id = DB::getPdo()->lastInsertId();

        User::factory(10)
            ->has(Person::factory()->count(1)->has(Paper::factory()->count(1)))
            ->has(Certificate::factory()->count(1))
            ->create([
                'role' => Role::GRADUATED,
                'group_id' => $id,
            ]);
    }
}
