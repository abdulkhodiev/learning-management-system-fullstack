<?php

namespace App\Actions\User;

use App\Actions\Mentor\CreateMentorAction;
use App\Http\Requests\Mentor\CreateMentorRequest;
use App\Models\User;

class CreateUserAction
{
    /**
     * Creates a new user, using the given data and assigns the user
     * the given role.
     *
     * @param array $data
     * @param string $role
     * @return User
     */
    public function execute(array $data, string $role): User
    {
        $user = User::create($data);
        $user->syncRoles($role);

        return $user;

    }
}



