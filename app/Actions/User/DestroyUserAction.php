<?php

namespace App\Actions\User;

use App\Models\User;

class DestroyUserAction
{

    /**
     * @param User $user
     * @return void
     */
    public function execute(User $user): void
    {
        $user->delete();
    }
}
