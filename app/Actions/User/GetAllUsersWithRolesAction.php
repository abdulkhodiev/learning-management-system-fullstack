<?php

namespace App\Actions\User;

use App\Models\User;

class GetAllUsersWithRolesAction
{
    /**
     * Execute the action to retrieve all users with their roles.
     *
     * This method uses Spatie's roles relationship to fetch all users
     * along with their roles. It maps over the collection of users and
     * assigns the first role to the user's `role` property, assuming
     * each user has a single role.
     *
     * @return \Illuminate\Support\Collection A collection of users with roles.
     */
    public function execute()
    {
        // Use Spatie's roles relationship to fetch roles
        return User::with('roles')->get()->map(function ($user) {
            $user->role = $user->roles->first(); // Extract the first role (single role assumption)
            return $user;
        });
    }
}
