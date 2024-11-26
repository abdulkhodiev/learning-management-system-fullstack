<?php

namespace App\Actions\Auth;

use App\Models\User;

class RegisterAction
{
    public function execute(array $fields): User
    {
        return User::create($fields);
    }
}
