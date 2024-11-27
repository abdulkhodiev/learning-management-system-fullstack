<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class DestroyRoleAction
{
    public function execute(Role $role): void
    {
        $role->delete();
    }
}
