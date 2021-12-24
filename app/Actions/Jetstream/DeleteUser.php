<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        abort(403);
        // todo: auth admin to delete
        // $user->deleteProfilePhoto();
        // $user->tokens->each->delete();
        // $user->delete();
    }
}
