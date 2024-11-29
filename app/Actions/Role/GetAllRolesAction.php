<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class GetAllRolesAction
{
    public function execute()
    {
        return Role::all();
    }
}
