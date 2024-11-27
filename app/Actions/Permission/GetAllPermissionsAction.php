<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class GetAllPermissionsAction
{
    public function execute(): Collection
    {
        return Permission::all();
    }
}
