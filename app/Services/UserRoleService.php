<?php

namespace App\Services;

use App\Interfaces\UserRole;

class UserRoleService implements UserRole
{
    public static function getNameByValue($value)
    {
        $class = new \ReflectionClass(__CLASS__);
        $constants = array_flip($class->getConstants());

        return $constants[$value];
    }
}
