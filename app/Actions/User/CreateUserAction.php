<?php

namespace App\Actions\User;

use App\Models\User;

class CreateUserAction
{
    public function execute(array $data, string $role): User
    {
        $user = User::create($data);
        $user->syncRoles($role);

        return $user;

    }
}



