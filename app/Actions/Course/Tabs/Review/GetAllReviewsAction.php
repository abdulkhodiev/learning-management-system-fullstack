<?php

namespace App\Actions\Course\Tabs\Review;

use App\Models\Course;
use App\Models\CourseReview;
use Illuminate\Database\Eloquent\Collection;

class GetAllReviewsAction
{

    /**
     * Returns all reviews for a course.
     *
     * @param int $courseId The course to get reviews for.
     *
     * @return array An array of reviews.
     *               Each review is an array with the following keys:
     *               - id
     *               - comment
     *               - rate
     *               - user (an array with 'id' and 'name')
     *               - course (an array with 'id' and 'title')
     */
    public function execute(int $courseId): array
    {
        $course = Course::with(['courseReview.user'])->find($courseId);

        if (!$course) {
            return [];
        }


        $reviews = $course->courseReview->map(function ($review) use ($course) {
            return [
                'id' => $review->id,
                'comment' => $review->comment,
                'rate' => $review->rate,
                'user' => [
                    'id' => $review->user->id,
                    'name' => $review->user->first_name . ' ' . $review->user->last_name,
                ],
                'course' => [
                    'id' => $course->id,
                    'title' => $course->title,
                ],
            ];
        });


        return $reviews->toArray();
    }
}
