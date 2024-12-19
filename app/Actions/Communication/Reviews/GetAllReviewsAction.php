<?php

namespace App\Actions\Communication\Reviews;

use App\Models\Course;
use App\Models\CourseReview;

class GetAllReviewsAction
{

    public function execute(): array
    {


        $reviews = CourseReview::with(['user', 'course'])->get()->map(function ($review) {
            return [
                'id' => $review->id,
                'comment' => $review->comment,
                'rate' => $review->rate,
                'user' => [
                    'id' => $review->user->id,
                    'name' => $review->user->first_name . ' ' . $review->user->last_name,
                ],
                'course' => [
                    'id' => $review->course->id,
                    'title' => $review->course->title,
                ],
            ];
        });


        return $reviews->toArray();
    }
}
