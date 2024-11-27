<?php

namespace App\Http\Controllers;

use App\Actions\Permission\CreatePermissionAction;
use App\Actions\Permission\DestroyPermissionAction;
use App\Actions\Permission\GetAllPermissionsAction;
use App\Actions\Permission\UpdatePermissionAction;
use App\Http\Requests\Permission\EditPermissionRequest;
use App\Http\Requests\Permission\CreatePermissionRequest;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;

class PermissionController extends Controller
{

    public function index(GetAllPermissionsAction $action)
    {
        $permissions = $action->execute();
        return Inertia::render('Permissions/Index', ['permissions' => $permissions]);
    }


    public function create()
    {
        return Inertia::render('Permissions/Create');
    }

    public function store(CreatePermissionRequest $request, CreatePermissionAction $action)
    {
        $permission = $action->execute($request->validated());
        return redirect()->route('permissions')->with('message', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        return Inertia::render('Permissions/Edit', ['permission' => $permission]);
    }

    public function update(EditPermissionRequest $request, Permission $permission, UpdatePermissionAction $action)
    {
        $updatedPermission = $action->execute($permission, $request->validated());
        return redirect()->route('permissions')->with('message', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission, DestroyPermissionAction $action)
    {
        $action->execute($permission);
        return redirect()->route('permissions')->with('message', 'Permission deleted successfully.');
    }
}
