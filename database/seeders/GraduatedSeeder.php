<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Paper;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class GraduatedSeeder extends Seeder
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
            ->has(Certificate::factory()->count(1))
            ->create(['role' => Role::GRADUATED]);
    }
}
