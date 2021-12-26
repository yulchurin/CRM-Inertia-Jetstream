<?php

namespace Database\Seeders;

use App\Models\LegalRepresentative;
use App\Models\Paper;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
            ->has(Person::factory()->count(1)->has(Paper::factory()->count(1)))
            ->create();
    }
}
