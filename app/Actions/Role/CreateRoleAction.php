<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class CreateRoleAction
{
    public function execute(array $data): Role
    {
        return Role::create($data);

    }
}
