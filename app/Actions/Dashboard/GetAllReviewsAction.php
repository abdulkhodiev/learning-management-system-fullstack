<?php

namespace App\Actions\Dashboard;

use App\Models\CourseReview;


class GetAllReviewsAction
{
    /**
     * Get all reviews with rate counts.
     *
     * @return array{
     *     number_of_reviews: int,
     *     number_of_reviews_with_rate_5: int,
     *     number_of_reviews_with_rate_4: int,
     *     number_of_reviews_with_rate_3: int,
     *     number_of_reviews_with_rate_2: int,
     *     number_of_reviews_with_rate_1: int,
     * }
     */
    public function execute(): array
    {
        $reviews = CourseReview::all();

        $number_of_reviews = $reviews->count();
        $number_of_reviews_with_rate_5 = $reviews->where('rate', 5)->count();
        $number_of_reviews_with_rate_4 = $reviews->where('rate', 4)->count();
        $number_of_reviews_with_rate_3 = $reviews->where('rate', 3)->count();
        $number_of_reviews_with_rate_2 = $reviews->where('rate', 2)->count();
        $number_of_reviews_with_rate_1 = $reviews->where('rate', 1)->count();

        return [
            'number_of_reviews' => $number_of_reviews,
            'number_of_reviews_with_rate_5' => $number_of_reviews_with_rate_5,
            'number_of_reviews_with_rate_4' => $number_of_reviews_with_rate_4,
            'number_of_reviews_with_rate_3' => $number_of_reviews_with_rate_3,
            'number_of_reviews_with_rate_2' => $number_of_reviews_with_rate_2,
            'number_of_reviews_with_rate_1' => $number_of_reviews_with_rate_1,
        ];
    }
}
