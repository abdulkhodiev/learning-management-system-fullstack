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

    /**
     * Show the list of permissions.
     *
     * @param  GetAllPermissionsAction  $action
     * @return \Inertia\Response
     */
    public function index(GetAllPermissionsAction $action)
    {
        $permissions = $action->execute();
        return Inertia::render('Permissions/Index', ['permissions' => $permissions]);
    }


    /**
     * Show the form for creating a new permission.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Permissions/Create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \App\Http\Requests\Permission\CreatePermissionRequest  $request
     * @param  \App\Actions\Permission\CreatePermissionAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePermissionRequest $request, CreatePermissionAction $action)
    {
        $permission = $action->execute($request->validated());
        return redirect()->route('permissions')->with('message', 'Permission created successfully.');
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Inertia\Response
     */
    public function edit(Permission $permission)
    {
        return Inertia::render('Permissions/Edit', ['permission' => $permission]);
    }

    /**
     * Update the specified permission in storage.
     *
     * @param  \App\Http\Requests\Permission\EditPermissionRequest  $request
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @param  \App\Actions\Permission\UpdatePermissionAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditPermissionRequest $request, Permission $permission, UpdatePermissionAction $action)
    {
        $updatedPermission = $action->execute($permission, $request->validated());
        return redirect()->route('permissions')->with('message', 'Permission updated successfully.');
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @param  \App\Actions\Permission\DestroyPermissionAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission, DestroyPermissionAction $action)
    {
        $action->execute($permission);
        return redirect()->route('permissions')->with('message', 'Permission deleted successfully.');
    }
}
