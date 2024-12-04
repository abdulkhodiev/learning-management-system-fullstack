<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{
    /**
     * Updates a user with the given data and role.
     *
     * The given $data array is expected to have the following keys:
     * - first_name
     * - last_name
     * - email
     * - username
     * - password (optional)
     *
     * If the password is not provided, it will be left unchanged.
     *
     * @param User $user
     * @param array $data
     * @param string $role
     */
    public function execute(User $user, array $data, string $role): void
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        $user->syncRoles($role);
    }
}
