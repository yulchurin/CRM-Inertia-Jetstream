<?php

namespace App\Services;

use App\Models\Appointment;

class LimitAppointment
{
    public static function weekly(): bool
    {
        return Appointment::ofThisStudent()->ofThisWeekAndHigher()->count() >= config('appointment.lessons.per_week');
    }

    public static function daily(): bool
    {
        return Appointment::ofThisStudent()->ofToday()->count() >= config('appointment.lessons.per_day');
    }

    public static function payment(): bool
    {
        return false;
    }

    public static function all(): bool
    {
        return self::weekly() || self::daily() || self::payment();
    }
}
