<?php

namespace App\Models;

enum Role: int
{
    case ADMIN = 10;
    case MANAGER = 11;
    case ASSISTANT = 12;
    case TEACHER = 21;
    case INSTRUCTOR = 22;
    case STUDENT = 31;

    /**
     * Just testing new features
     *
     * @return string
     */
    public function something(): string
    {
        return match ($this)
        {
            self::ADMIN => 'admin',
            self::ASSISTANT => 'assistant',
            self::MANAGER => 'manager',
            self::TEACHER => 'teacher',
            self::INSTRUCTOR => 'instructor',
            self::STUDENT => 'student',
        };
    }
}
