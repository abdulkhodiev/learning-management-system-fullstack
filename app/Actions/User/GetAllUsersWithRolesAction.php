<?php

namespace App\Actions\User;

use App\Models\User;

class GetAllUsersWithRolesAction
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function execute()
    {
        return User::with('roles')->get()->map(function ($user) {
            $user->role = $user->roles->first();
            return $user;
        });
    }
}
