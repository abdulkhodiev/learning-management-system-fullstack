<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    /**
     * Updates a role with given data.
     *
     * @param Role $role The role to be updated.
     * @param array $data The data to update the role with.
     *                      Should contain at least the name and permissions.
     *
     * @return Role The updated role.
     */
    public function execute(Role $role, array $data): Role
    {
        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions']);


        return $role;
    }
}
