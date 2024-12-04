<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class CreateRoleAction
{
    /**
     * Creates a new role from the given data
     *
     * @param array $data The role data
     * @return Role The created role
     */
    public function execute(array $data): Role
    {
        return Role::create($data);

    }
}
