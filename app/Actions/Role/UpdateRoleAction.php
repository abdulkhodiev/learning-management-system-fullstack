<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    public function execute(Role $role, array $data): Role
    {
        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions']);


        return $role;
    }
}
