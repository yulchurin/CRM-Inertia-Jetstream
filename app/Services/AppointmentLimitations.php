<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

/**
 * If the limit is reached, the method will return true
 */
class AppointmentLimitations
{
    /**
     * Determines whether the Student has used up the weekly booking limit
     *
     * @return bool
     */
    public static function weekly(): bool
    {
        $student = Auth::user()->getAsStudent();
        $group = Group::find($student->group?->id);

        $groupLimitPerWeek = $group->limit?->per_week;
        $studentLimitPerWeek = $student->limit?->per_week;

        $limitPerWeek = $studentLimitPerWeek ?? $groupLimitPerWeek;

        return Appointment::ofThisStudent()
                ->ofThisWeekAndHigher()
                ->count() >= $limitPerWeek;
    }

    /**
     * Determines whether the Student has used up the daily booking limit
     *
     * @return bool
     */
    public static function daily(): bool
    {
        $student = Auth::user()->getAsStudent();
        $group = Group::find($student->group?->id);

        $groupLimitPerDay = $group->limit?->per_day;
        $studentLimitPerDay = $student->limit?->per_day;

        $limitPerDay = $studentLimitPerDay ?? $groupLimitPerDay;

        return Appointment::ofThisStudent()
                ->ofToday()
                ->count() >= $limitPerDay;
    }

    /**
     * Determines whether the Student has paid the amount sufficient to book the lessons
     *
     * @return bool
     */
    public static function payment(): bool
    {
        return false;
    }

    /**
     * Determines whether the allotted time has been spent
     *
     * @return bool
     */
    public static function allottedTime(): bool
    {
        $appointments = Appointment::ofThisStudent()->with('schedule')->get();
        $student = Auth::user()->getAsStudent();
        $group = Group::find($student->group?->id);

        $totalSpentSeconds = $appointments->sum(function ($appointment) {
            return $appointment->schedule?->duration;
        });

        // divide by 3600 = hours (60 minutes in one hour, 60 seconds in one minute - 60*60)
        return ($totalSpentSeconds / 3600) >= $group?->getDriveHours();
    }

    /**
     * Checks all limitations in this class
     *
     * @return bool
     */
    public static function all(): bool
    {
        return
            self::weekly() ||
            self::allottedTime() ||
            self::daily() ||
            self::payment();
    }
}
