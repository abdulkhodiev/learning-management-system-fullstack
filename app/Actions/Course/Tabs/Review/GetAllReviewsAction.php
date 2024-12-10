<?php

namespace App\Actions\Course\Tabs\Review;

use App\Models\CourseReview;

class GetAllReviewsAction
{
    public function execute(int $courseId): array
    {
        $reviews = CourseReview::where('course_id', $courseId)->get();

        return $reviews->toArray();

    }
}
