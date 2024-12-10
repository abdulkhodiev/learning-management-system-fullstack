<?php

namespace App\Http\Controllers\CourseControllers;

use App\Actions\Course\Tabs\Review\GetAllReviewsAction;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Inertia\Inertia;
use Inertia\Response;

class CourseReviewsController extends Controller
{
    /**
     * Get all reviews for a course.
     *
     * @param Course $course The course to get reviews for.
     * @param GetAllReviewsAction $getAllReviewsAction The action to get all reviews.
     * @return Response A response containing the reviews.
     */
    public function index(Course $course, GetAllReviewsAction $getAllReviewsAction): Response
    {

        $reviews = $getAllReviewsAction->execute($course->id);
        return Inertia::render('Courses/Tabs/Reviews/Index', [
            'reviews' => $reviews
        ]);
    }
}
