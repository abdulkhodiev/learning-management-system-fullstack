<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class CreatePermissionAction
{
    public function execute(array $data): Permission
    {
        return Permission::create($data);
    }
}
