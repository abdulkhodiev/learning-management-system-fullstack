<?php

namespace App\Http\Controllers;

use App\Actions\Role\CreateRoleAction;
use App\Actions\Role\DestroyRoleAction;
use App\Actions\Role\GetAllRolesAction;
use App\Actions\Role\GetAllRolesWithPermissionsAction;
use App\Actions\Role\UpdateRoleAction;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\EditRoleRequest;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index(GetAllRolesAction $action)
    {
        $roles = $action->execute();
        return Inertia::render('Roles/Index', ['roles' => $roles]);
    }


    public function rolesWithPermissions(GetAllRolesWithPermissionsAction $action)
    {
        $roles = $action->execute();
        return Inertia::render('Roles/RolesWithPermissions', ['roles' => $roles]);
    }


    public function create()
    {
        return Inertia::render('Roles/Create');
    }


    public function store(CreateRoleRequest $request, CreateRoleAction $action)
    {
        $action->execute($request->validated());
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }


    public function edit(Role $role)
    {
        return Inertia::render('Roles/Edit', [
            'role' => $role->load('permissions'),
        ]);
    }


    public function update(EditRoleRequest $request, Role $role, UpdateRoleAction $action)
    {
        $action->execute($role, $request->validated());
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }


    public function destroy(Role $role, DestroyRoleAction $action)
    {
        $action->execute($role);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
