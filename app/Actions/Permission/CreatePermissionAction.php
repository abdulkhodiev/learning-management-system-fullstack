<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class CreatePermissionAction
{
    /**
     * Create a new permission.
     *
     * @param array $data The data used to create the permission.
     * @return Permission The created permission instance.
     */
    public function execute(array $data): Permission
    {
        return Permission::create($data);
    }
}
