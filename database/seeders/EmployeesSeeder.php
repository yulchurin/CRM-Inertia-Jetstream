<?php

namespace Database\Seeders;

use App\Interfaces\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)
            ->sequence(fn () => ['role' => UserRole::OWNER])
            ->create([
                'email' => 'owner@this.test',
                'active' => true,
            ]);

        User::factory(1)
            ->sequence(fn () => ['role' => UserRole::ADMIN])
            ->create([
                'email' => 'admin@this.test',
                'active' => true,
            ]);

        User::factory(2)
            ->sequence(fn () => ['role' => UserRole::TEACHER])
            ->create([
                'active' => true,
            ]);

        User::factory(5)
            ->sequence(fn () => ['role' => UserRole::INSTRUCTOR])
            ->create([
                'active' => true,
            ]);
    }
}
