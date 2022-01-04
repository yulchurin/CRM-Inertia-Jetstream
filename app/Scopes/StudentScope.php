<?php

namespace App\Scopes;

use App\Interfaces\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class StudentScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder
            ->where('role', '=', UserRole::STUDENT)
            ->orWhere('role', '=', UserRole::GRADUATED)
            ->orWhere('role', '=', UserRole::ENROLLEE);
    }
}
