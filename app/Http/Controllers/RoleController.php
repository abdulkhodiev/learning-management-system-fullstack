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

    /**
     * Show all roles with their permissions.
     *
     * @param GetAllRolesWithPermissionsAction $action
     * @return \Inertia\Response
     */
    public function index(GetAllRolesWithPermissionsAction $action)
    {
        $roles = $action->execute();

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new role, including available permissions.
     *
     * @param GetAllPermissionsAction $action
     * @return \Inertia\Response
     */
    public function create(GetAllPermissionsAction $action)
    {
        $permissions = $action->execute();
        return Inertia::render('Roles/CreateEdit', [
            'permissions' => $permissions
        ]);
    }



    /**
     * Create a new role, including its permissions.
     *
     * @param CreateRoleRequest $request
     * @param CreateRoleAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRoleRequest $request, CreateRoleAction $action)
    {
        $action->execute($request->validated());
        return redirect()->route('roles.index')->with('message', 'Role created successfully.');
    }


    /**
     * Show the form for editing a role, including its current permissions and available permissions.
     *
     * @param Role $role
     * @param GetRoleWithPermissionsAction $roleGetWithPermissions
     * @param GetAllPermissionsAction $permissions
     * @return \Inertia\Response
     */
    public function edit(Role $role, GetRoleWithPermissionsAction $roleGetWithPermissions, GetAllPermissionsAction $permissions)
    {
        $role = $roleGetWithPermissions->execute($role);
        $permissions = $permissions->execute();
        return Inertia::render('Roles/CreateEdit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }


    /**
     * Update the specified role with new data and permissions.
     *
     * @param EditRoleRequest $request
     * @param Role $role
     * @param UpdateRoleAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditRoleRequest $request, Role $role, UpdateRoleAction $action)
    {
        $action->execute($role, $request->validated());
        return redirect()->route('roles.index')->with('message', 'Role updated successfully.');
    }


    /**
     * Remove the specified role from storage.
     *
     * @param Role $role
     * @param DestroyRoleAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role, DestroyRoleAction $action)
    {
        $action->execute($role);
        return redirect()->route('roles')->with('success', 'Role deleted successfully.');
    }
}
