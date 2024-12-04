<?php

namespace App\Actions\User;

use App\Models\User;

class UserWithRolesAction
{
    /**
     * Loads the roles relationship for the given user and assigns
     * the first role from the user's roles collection to the user's
     * role property.
     *
     * @param User $user The user object to load roles for.
     * @return User The user object with loaded roles and assigned role property.
     */
    public function execute(User $user): User
    {
        $user->load('roles');
        $user->role = $user->roles->first();
        return $user;
    }
}
