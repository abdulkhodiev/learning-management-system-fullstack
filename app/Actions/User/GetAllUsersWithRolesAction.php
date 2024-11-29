<?php

namespace App\Actions\User;

use App\Models\User;

class GetAllUsersWithRolesAction
{
    public function execute()
    {
        // Use Spatie's roles relationship to fetch roles
        return User::with('roles')->get()->map(function ($user) {
            $user->role = $user->roles->first(); // Extract the first role (single role assumption)
            return $user;
        });
    }
}
