<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{

    /**
     * @param User $user
     * @param array $data
     * @param string $role
     * @return void
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
