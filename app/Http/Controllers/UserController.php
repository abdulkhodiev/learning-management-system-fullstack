<?php

namespace App\Http\Controllers;

use App\Actions\Mentor\CreateMentorAction;
use App\Actions\Mentor\DestroyMentorAction;
use App\Actions\Mentor\UpdateMentorAction;
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

    /**
     * @param GetAllUsersWithRolesAction $action
     * @return \Inertia\Response
     */
    public function index(GetAllUsersWithRolesAction $action)
    {
        $users = $action->execute();
        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }


    /**
     * @param GetAllRolesAction $roles
     * @return \Inertia\Response
     */
    public function create(GetAllRolesAction $roles)
    {
        $roles = $roles->execute();
        return Inertia::render('Users/CreateEdit', [
            'roles' => $roles
        ]);
    }

    /**
     * @param CreateUserRequest $request
     * @param CreateUserAction $action
     * @param CreateMentorAction $mentorAction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request, CreateUserAction $action, CreateMentorAction $mentorAction)
    {
        \DB::transaction(function () use ($request, $action, $mentorAction) {
            // Create the user
            $user = $action->execute($request->validated(), $request->role);

            // Handle mentor-specific logic
            if ($request->role === 'mentor') {
                $mentorAction->execute([
                    'user_id' => $user->id,
                    'fields' => $request->input('fields'),
                    'experience' => $request->input('experience'),
                ]);
            }
        });

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * @param User $user
     * @param UserWithRolesAction $userAction
     * @param GetAllRolesAction $rolesAction
     * @return \Inertia\Response
     */
    public function edit(User $user, UserWithRolesAction $userAction, GetAllRolesAction $rolesAction)
    {
        $user = $userAction->execute($user);
        $roles = $rolesAction->execute();

        $mentorData = $user->mentor ? [
            'fields' => $user->mentor->fields,
            'experience' => $user->mentor->experience,
        ] : null;

        return Inertia::render('Users/CreateEdit', [
            'user' => $user,
            'roles' => $roles,
            'mentor' => $mentorData,
        ]);
    }


    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @param UpdateUserAction $userAction
     * @param UpdateMentorAction $updateMentorAction
     * @param DestroyMentorAction $destroyMentorAction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        UpdateUserRequest $request,
        User $user,
        UpdateUserAction $userAction,
        UpdateMentorAction $updateMentorAction,
        DestroyMentorAction $destroyMentorAction
    ) {
        \DB::transaction(function () use ($request, $user, $userAction, $updateMentorAction, $destroyMentorAction) {
            $userAction->execute($user, $request->validated(), $request->role);

            if ($request->role === 'mentor') {
                $mentorData = [
                    'user_id' => $user->id,
                    'fields' => $request->input('fields'),
                    'experience' => $request->input('experience'),
                ];

                if ($user->mentor) {
                    // Update mentor data
                    $updateMentorAction->execute($user->mentor, $mentorData);
                } else {
                    // Create new mentor data
                    $updateMentorAction->execute(null, $mentorData);
                }
            } else {
                // If no longer a mentor, delete mentor data
                if ($user->mentor) {
                    $destroyMentorAction->execute($user->mentor);
                }
            }
        });

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * @param User $user
     * @param DestroyUserAction $userAction
     * @param DestroyMentorAction $destroyMentorAction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user, DestroyUserAction $userAction, DestroyMentorAction $destroyMentorAction)
    {
        \DB::transaction(function () use ($user, $userAction, $destroyMentorAction) {
            // Delete mentor-specific data if it exists
            if ($user->mentor) {
                $destroyMentorAction->execute($user->mentor);
            }

            // Delete the user
            $userAction->execute($user);
        });

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


}
