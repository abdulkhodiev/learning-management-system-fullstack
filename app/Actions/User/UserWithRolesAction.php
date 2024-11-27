<?php

namespace App\Actions\User;

use App\Models\User;

class UserWithRolesAction
{
    public function execute(User $user): User
    {
        return $user->load('roles');
    }
}
