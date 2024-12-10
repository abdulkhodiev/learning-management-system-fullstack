<?php

namespace App\Http\Controllers\CourseControllers;

use App\Actions\Course\Tabs\Commissions\GetAllCommissionsAction;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Inertia\Inertia;
use Inertia\Response;

class CourseCommissionController extends Controller
{
    /**
     * Displays the commissions for a given course.
     *
     * @param Course $course
     * @param GetAllCommissionsAction $getAllCommissionsAction
     * @return Response
     */
    public function index(Course $course, GetAllCommissionsAction $getAllCommissionsAction): Response
    {
        if (!$course) {
            return Inertia::render('Courses/Tabs/Commissions/Index', [
                'error' => 'Course not found',
            ]);
        }

        $commissions = $getAllCommissionsAction->execute($course->id);

        return Inertia::render('Courses/Tabs/Commissions/Index', [
            'commissions' => $commissions,

        ]);

    }
}
