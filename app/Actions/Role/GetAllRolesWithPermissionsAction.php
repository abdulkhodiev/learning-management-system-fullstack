<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class GetAllRolesWithPermissionsAction
{
    /**
     * Fetch all roles with their permissions.
     *
     * @return Collection<\Spatie\Permission\Models\Role>
     */
    public function execute(): Collection
    {
        return Role::with('permissions')->get();
    }
}
