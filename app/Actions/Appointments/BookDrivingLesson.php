<?php declare(strict_types=1);

namespace App\Actions\Appointments;

use App\Actions\Interfaces\MainAction;
use App\Actions\Interfaces\MainDTO;
use App\Models\Appointment;
use App\Models\Place;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookDrivingLesson implements MainAction
{
    public function __invoke(MainDTO $data): void
    {
        $appointment = Appointment::find($data->id);
        $appointment->place()->associate(Place::find($data->place));
        $appointment->student()->associate(Student::find(Auth::id()));
        $appointment->comment = $data->comment;

        $appointment->save();
        Log::channel('user_actions')->info(Auth::id() . ': ' .json_encode($data));
    }
}
