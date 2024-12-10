<?php

namespace App\Actions\Course\Tabs\Review;

use App\Models\CourseReview;

class GetAllReviewsAction
{
    /**
     * Get all reviews for the course with the given id.
     *
     * @param int $courseId
     * @return array
     */
    public function execute(int $courseId): array
    {
        $reviews = CourseReview::where('course_id', $courseId)->get();

        return $reviews->toArray();

    }
}
