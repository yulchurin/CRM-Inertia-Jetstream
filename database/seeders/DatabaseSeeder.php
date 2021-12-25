<?php

namespace Database\Seeders;

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
        User::factory()->count(1)
            ->sequence(fn () => [
                'email' => 'admin@this.test',
                'role' => Role::ADMIN,
            ])->create();

        User::factory()->count(1)
            ->sequence(fn () => [
                'email' => 'assistant@this.test',
                'role' => Role::ASSISTANT,
            ])->create();

        $this->call([
            CompanySeeder::class,
            StudentSeeder::class,
            MinorStudentSeeder::class,
            GraduatedSeeder::class,
        ]);
    }
}
