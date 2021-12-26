<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        $this->call([
            CompanySeeder::class,
            StudentSeeder::class,
            MinorStudentSeeder::class,
            GraduatedSeeder::class,
        ]);
    }
}
