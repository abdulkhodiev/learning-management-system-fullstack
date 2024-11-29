<?php

namespace App\Actions\User;

use App\Models\User;

class UserWithRolesAction
{
    public function execute(User $user): User
    {
        $user->load('roles');
        $user->role = $user->roles->first();
        return $user;
    }
}
