<?php

namespace App\Actions\User;

use App\Models\User;

class DestroyUserAction
{
    /**
     * Deletes a user.
     *
     * @param User $user The user to be deleted.
     */
    public function execute(User $user): void
    {
        $user->delete();
    }
}
