<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class GetRoleWithPermissionsAction
{

    /**
     * @param Role $role
     * @return Role
     */
    //
    public function execute(Role $role): Role
    {
        $role->load('permissions');
        return $role;
    }
}
