<?php

namespace App\Http\Controllers;

use App\Actions\User\GetAllUsersWithRolesAction;
use App\Actions\Role\GetAllRolesAction;
use App\Actions\User\CreateUserAction;
use App\Actions\User\DestroyUserAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\UserWithRolesAction;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(GetAllUsersWithRolesAction $action)
    {
        $users = $action->execute();
        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    public function create(GetAllRolesAction $roles)
    {
        $roles = $roles->execute();
        return Inertia::render('Users/CreateEdit', [
            'roles' => $roles
        ]);
    }

    public function store(CreateUserRequest $request, CreateUserAction $action)
    {

        $action->execute($request->validated(), $request->role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function edit(User $user, UserWithRolesAction $userAction, GetAllRolesAction $rolesAction)
    {
        $user = $userAction->execute($user);
        $roles = $rolesAction->execute();

        return Inertia::render('Users/CreateEdit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(UpdateUserRequest $request, User $user, UpdateUserAction $action)
    {

        $action->execute($user, $request->validated(), $request->role);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user, DestroyUserAction $action)
    {
        $action->execute($user);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
