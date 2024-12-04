<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class DestroyPermissionAction
{
    /**
     * Deletes a permission from the database.
     *
     * @param Permission $permission the permission to delete
     */
    public function execute(Permission $permission): void
    {
        $permission->delete();
    }
}
