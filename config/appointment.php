<?php

return [

    'start' => [
        'hours_before' => env('APPOINTMENT_AVAILABLE_BEFORE_HOURS', 8),
    ],

    'lessons' => [
        'per_week' => env('DRIVING_LESSONS_PER_WEEK', 2),
        'per_day' => env('DRIVING_LESSONS_PER_DAY', 1),
    ],
];
