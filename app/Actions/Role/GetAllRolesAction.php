<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class GetAllRolesAction
{

    /**
     * Retrieve all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[]
     */
    public function execute()
    {
        return Role::all();
    }
}
