<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class DestroyRoleAction
{

    /**
     * @param Role $role
     * @return void
     */
    public function execute(Role $role): void
    {
        $role->delete();
    }
}
