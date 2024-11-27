<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class GetAllRolesWithPermissionsAction
{
    public function execute(): Collection
    {
        return Role::with('permissions')->get();
    }
}
