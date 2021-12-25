<?php

namespace App\Models;

enum Role: int
{
    case ADMIN = 10;
    case MANAGER = 11;
    case ASSISTANT = 12;
    case TEACHER = 21;
    case INSTRUCTOR = 22;
    case ENROLLEE = 30;
    case STUDENT = 31;
    case GRADUATED = 32;

    /**
     * Just testing new features
     *
     * @return string
     */
    public function actions(): string
    {
        return match ($this)
        {
            self::ADMIN => 'admin may do anything',
            self::ASSISTANT => 'assistant may do almost anything like admin, but cant edit Company data',
            self::MANAGER => 'manager is Person that sign docs',
            self::TEACHER => 'teacher may create and edit schedule, cancel lessons etc.',
            self::INSTRUCTOR => 'instructor may cancel driving lessons',
            self::STUDENT => 'students may edit their own data but it should be logged and with request limitations (1 per day or something like that)',
            self::ENROLLEE => 'enrolling... no permissions, only registration',
            self::GRADUATED => 'graduated... no permissions to edit or create, only download docs',
        };
    }
}
