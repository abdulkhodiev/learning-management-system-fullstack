<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class GetAllPermissionsAction
{
    /**
     * Retrieves all permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission>
     */
    public function execute(): Collection
    {
        return Permission::all();
    }
}
