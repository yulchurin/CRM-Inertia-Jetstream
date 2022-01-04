<?php

namespace App\Interfaces;

interface UserRole
{
    public const OWNER = -108;
    public const ADMIN = -107;

    public const TEACHER = -10;
    public const INSTRUCTOR = -11;

    public const ENROLLEE = 30;
    public const STUDENT = 31;
    public const GRADUATED = 32;
}
