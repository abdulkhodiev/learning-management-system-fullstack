<?php

namespace App\Actions\Auth;

use App\Models\User;

class RegisterAction
{
    /**
     * Execute the user registration action.
     *
     * @param array $fields The fields for creating a new user.
     * @return User The newly created user instance.
     */
    public function execute(array $fields): User
    {
        return User::create($fields);
    }
}
