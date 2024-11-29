<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class GetRoleWithPermissionsAction
{

    public function execute(Role $role): Role
    {
        $role->load('permissions');
        return $role;
    }
}
