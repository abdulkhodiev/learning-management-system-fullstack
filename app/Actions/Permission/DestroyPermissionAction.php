<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class DestroyPermissionAction
{
    public function execute(Permission $permission): void
    {
        $permission->delete();
    }
}
