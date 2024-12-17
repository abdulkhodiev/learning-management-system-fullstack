<?php

namespace App\Actions\Communication\Reviews;

use App\Models\CourseReview;



class GetAllReviewsAction
{
    /**
     * Returns all reviews.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\CourseReview[]
     */
    public function execute()
    {
        return CourseReview::all();
    }
}
