<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::with('roles')->get(),
        ]);
    }

    public function create()
    {
        $roles = GetAllRolesAction::class::execute();
        return Inertia::render('Users/Create', [
            'roles' => $roles
        ]);
    }

    public function store(CreateUserRequest $request, CreateUserAction $action)
    {
        $action->execute($request->validated(), $request->roles);
        return redirect()->route('users')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $user = UserWithRolesAction::class::execute($user);
        $roles = GetAllRolesAction::class::execute();

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(UpdateUserRequest $request, User $user, UpdateUserAction $action)
    {
        $action->execute($user, $request->validated(), $request->roles);
        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user, DestroyUserAction $action)
    {
        $action->execute($user);
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
