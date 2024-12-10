<?php

namespace App\Http\Controllers\CourseControllers;

use App\Actions\Course\Tabs\Review\GetAllReviewsAction;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Inertia\Inertia;
use Inertia\Response;

class CourseReviewsController extends Controller
{
    public function index(Course $course, GetAllReviewsAction $getAllReviewsAction): Response
    {

        $reviews = $getAllReviewsAction->execute($course->id);
        return Inertia::render('Courses/Tabs/Reviews/Index', [
            'reviews' => $reviews
        ]);
    }
}
