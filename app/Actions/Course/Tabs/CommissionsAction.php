<?php

namespace App\Actions\Course\Tabs;

use App\Models\Course;


class CommissionsAction
{
    public function execute($mentorId = null, $startDate = null, $endDate = null)
    {
        $query = Course::with(['users' => function ($query) use ($startDate, $endDate) {
            if ($startDate && $endDate) {
                $query->wherePivot('purchased_at', '>=', $startDate)
                      ->wherePivot('purchased_at', '<=', $endDate);
            }
        }]);

        if ($mentorId) {
            $query->where('mentor_id', $mentorId);
        }

        $courses = $query->get();

        // Process commissions
        return $courses->map(function ($course) {
            $totalEarnings = $course->students->sum(function ($student) {
                return $student->pivot->price;
            });

            return [
                'course_title' => $course->title,
                'total_students' => $course->students->count(),
                'total_earnings' => $totalEarnings,
                'mentor' => $course->mentor->name ?? 'Unknown',
            ];
        });
    }
}
