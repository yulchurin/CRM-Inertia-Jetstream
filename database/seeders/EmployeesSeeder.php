<?php

namespace Database\Seeders;

use App\Models\Role;
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
            ->create([
                'email' => 'admin@this.test',
                'role' => Role::ADMIN,
                'active' => true,
            ]);

        User::factory(1)
            ->create([
                'email' => 'assistant@this.test',
                'role' => Role::ASSISTANT,
                'active' => true,
            ]);

        User::factory(1)
            ->create([
                'email' => 'manager@this.test',
                'role' => Role::MANAGER,
                'active' => true,
            ]);

        User::factory(2)
            ->create([
                'role' => Role::TEACHER,
                'active' => true,
            ]);

        User::factory(5)
            ->create([
                'role' => Role::INSTRUCTOR,
                'active' => true,
            ]);
    }
}
