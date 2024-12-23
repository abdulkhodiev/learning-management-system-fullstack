<?php

namespace App\Actions\Course;

use App\Models\Course;

class GetAllCoursesAction
{

    /**
     * Get all courses with mentor, chapters, lessons, orders, reviews and coupons.
     *
     * @return array
     */
    public function execute(): array
    {
        $courses = Course::with([
            'chapters',
            'users',
            'courseReview',
            'coupon',
            'mentor'
        ])->get();

        return $courses->map(function ($course) {
            return [
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'price' => $course->price,
                'mentor' => $course->mentor->name ?? null,
                'number_of_chapters' => $course->chapters->count(),
                'number_of_lessons' => $course->chapters->sum(fn ($chapter) => $chapter->lessons->count()),
                'number_of_orders' => $course->users->count(),
                'number_of_reviews' => $course->courseReview->count(),
                'average_rating' => $course->courseReview->avg('rate'),
                'number_of_coupons' => $course->coupon->count(),
                'languages' => $course->languages,
            ];
        })->toArray();
    }
}
