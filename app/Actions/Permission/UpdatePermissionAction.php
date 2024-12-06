<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class UpdatePermissionAction
{
    /**
     * Updates a permission.
     *
     * @param Permission $permission
     * @param array $data
     * @return Permission
     */
    public function execute(Permission $permission, array $data): Permission
    {
        $permission->update(['name' => $data['name']]);

        return $permission;
    }
}
