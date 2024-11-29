<?php

namespace App\Http\Controllers;

use App\Actions\Role\CreateRoleAction;
use App\Actions\Role\DestroyRoleAction;
use App\Actions\Role\GetAllRolesWithPermissionsAction;
use App\Actions\Role\GetRoleWithPermissionsAction;
use App\Actions\Permission\GetAllPermissionsAction;
use App\Actions\Role\UpdateRoleAction;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\EditRoleRequest;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index(GetAllRolesWithPermissionsAction $action)
    {
        $roles = $action->execute();

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    public function create(GetAllPermissionsAction $action)
    {
        $permissions = $action->execute();
        return Inertia::render('Roles/CreateEdit', [
            'permissions' => $permissions
        ]);
    }


    public function store(CreateRoleRequest $request, CreateRoleAction $action)
    {
        $action->execute($request->validated());
        return redirect()->route('roles.index')->with('message', 'Role created successfully.');
    }


    public function edit(Role $role, GetRoleWithPermissionsAction $roleGetWithPermissions, GetAllPermissionsAction $permissions)
    {
        $role = $roleGetWithPermissions->execute($role);
        $permissions = $permissions->execute();
        return Inertia::render('Roles/CreateEdit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }


    public function update(EditRoleRequest $request, Role $role, UpdateRoleAction $action)
    {
        $action->execute($role, $request->validated());
        return redirect()->route('roles.index')->with('message', 'Role updated successfully.');
    }


    public function destroy(Role $role, DestroyRoleAction $action)
    {
        $action->execute($role);
        return redirect()->route('roles')->with('success', 'Role deleted successfully.');
    }
}
