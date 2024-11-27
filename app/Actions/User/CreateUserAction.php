<?php

namespace App\Actions\User;

use App\Models\User;

class CreateUserAction
{
    public function execute(array $data, array $roles): User
    {
        $user = User::create($data);
        $user->syncRoles($roles);

        return $user;

    }
}



