<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\DrivingSchedule;
use App\Models\Place;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DrivingSchedule::factory(10)->create();
        Place::factory(9)->create();
        Appointment::factory(50)->create();
    }
}
