<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class DestroyRoleAction
{
    /**
     * Deletes a role.
     *
     * @param Role $role The role to be deleted.
     */
    public function execute(Role $role): void
    {
        $role->delete();
    }
}
