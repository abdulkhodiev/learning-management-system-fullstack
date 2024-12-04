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
use App\Http\Requests\Mentor\CreateMentorRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
/**
 * Display a listing of users along with their roles.
 *
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
     * Display a form for creating a new user.
     *
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
     * Update the specified user with new data and role.
     *
     * The given $request array is expected to have the following keys:
     * - first_name
     * - last_name
     * - email
     * - username
     * - password (optional)
     * - role
     * - fields
     * - experience
     *
     * If the password is not provided, it will be left unchanged.
     *
     * If the user is a mentor, update or create mentor-specific data.
     * If the user is no longer a mentor, delete the mentor record.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @param UpdateUserAction $action
     * @param CreateMentorAction $mentorAction
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
