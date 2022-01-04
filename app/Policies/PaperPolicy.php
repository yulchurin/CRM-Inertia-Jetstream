<?php

namespace App\Policies;

use App\Models\Paper;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaperPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Paper $paper)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $student = Student::find($user->id);
        return ! $student->paper()->exists();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Paper $paper)
    {
        $student = Student::find($user->id);
        return $student->person?->id === $paper->person_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Paper $paper)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Paper $paper)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Paper $paper)
    {
        //
    }
}
