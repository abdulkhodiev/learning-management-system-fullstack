<?php

namespace App\Actions\Communication\Messages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetAllStudentsAction
{
    /**
     * Execute the action to fetch all students for the authenticated mentor.
     *
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function execute()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user is a mentor
        if (!$user || !$user->mentor) {
            throw new \Exception('Authenticated user is not a mentor.');
        }

        // Get the mentor ID
        $mentorId = $user->mentor->id;

        // Retrieve all students of the mentor
        $students = User::whereHas('courses', function ($query) use ($mentorId) {
            $query->where('mentor_id', $mentorId);
        })->get();

        return $students;
    }
}
