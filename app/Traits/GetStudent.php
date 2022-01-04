<?php

namespace App\Traits;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

trait GetStudent
{
    /**
     * Gets student model by Authenticated user->id
     *
     * as Student (extended User Model)
     *
     * @return Student|null
     */
    private function getStudent(): Student|null
    {
        if (Auth::user()->mayHavePerson()) {
            return Student::find(Auth::id());
        }

        return null; // yes, it is bad =)
    }
}
