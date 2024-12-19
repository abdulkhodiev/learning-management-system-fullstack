<?php

namespace App\Actions\Course\Tabs\Review;

use App\Models\Course;
use App\Models\CourseReview;

class GetTotalInfoAction
{

    /**
     * Get total information about reviews for a specific course.
     *
     * This includes the total number of reviews and the number of reviews
     * for each rating from 1 to 5.
     *
     * @param int $courseId The ID of the course for which to retrieve review information.
     *
     * @return array An associative array containing:
     *               - 'number_of_reviews': Total number of reviews.
     *               - 'number_of_reviews_with_rate_5': Reviews with a rating of 5.
     *               - 'number_of_reviews_with_rate_4': Reviews with a rating of 4.
     *               - 'number_of_reviews_with_rate_3': Reviews with a rating of 3.
     *               - 'number_of_reviews_with_rate_2': Reviews with a rating of 2.
     *               - 'number_of_reviews_with_rate_1': Reviews with a rating of 1.
     *
     * @throws \Exception If the course is not found.
     */

    public function execute(int $courseId): array
    {
        $course = Course::with(['courseReview.user'])->find($courseId);

        if (!$course) {
            throw new \Exception('Course not found.');
        }

        $reviews = $course->courseReview();

        $numberOfReviews = $reviews->count();
        $numberOfReviewsWithRate5 = $reviews->where('rate', 5)->count();
        $numberOfReviewsWithRate4 = $reviews->where('rate', 4)->count();
        $numberOfReviewsWithRate3 = $reviews->where('rate', 3)->count();
        $numberOfReviewsWithRate2 = $reviews->where('rate', 2)->count();
        $numberOfReviewsWithRate1 = $reviews->where('rate', 1)->count();

        return [
            'number_of_reviews' => $numberOfReviews,
            'number_of_reviews_with_rate_5' => $numberOfReviewsWithRate5,
            'number_of_reviews_with_rate_4' => $numberOfReviewsWithRate4,
            'number_of_reviews_with_rate_3' => $numberOfReviewsWithRate3,
            'number_of_reviews_with_rate_2' => $numberOfReviewsWithRate2,
            'number_of_reviews_with_rate_1' => $numberOfReviewsWithRate1,
        ];
    }
}
