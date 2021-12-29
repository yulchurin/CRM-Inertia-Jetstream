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
        $owner = Role::where('name', 'owner')->first();
        $admin = Role::where('name', 'admin')->first();
        $teacher = Role::where('name', 'teacher')->first();
        $instructor = Role::where('name', 'teacher')->first();

        User::factory(1)
            ->create([
                'email' => 'admin@this.test',
                'active' => true,
            ]);

        User::factory(1)
            ->create([
                'email' => 'assistant@this.test',
                'active' => true,
            ]);

        User::factory(2)
            ->create([
                'active' => true,
            ]);

        User::factory(5)
            ->create([
                'active' => true,
            ]);
    }
}
