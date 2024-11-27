<?php

namespace App\Actions\User;

use App\Models\User;

class DestroyUserAction
{
    public function execute(User $user): void
    {
        $user->delete();
    }
}
