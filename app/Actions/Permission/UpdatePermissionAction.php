<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class UpdatePermissionAction
{
    public function execute(Permission $permission, array $data): Permission
    {
        $permission->update(['name' => $data['name']]);
        return $permission;
    }
}
