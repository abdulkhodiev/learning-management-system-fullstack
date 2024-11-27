<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class GetAllRolesAction
{
    public function execute(): Collection
    {
        return Role::all();
    }
}
