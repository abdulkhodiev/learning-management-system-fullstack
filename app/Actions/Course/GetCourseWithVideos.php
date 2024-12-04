<?php

namespace App\Actions\Course;

use App\Models\Course;

class GetCourseWithVideos
{
    /**
     * Return the given course with its videos
     *
     * @param Course $course
     * @return Course
     */
    public function execute(Course $course)
    {
        return $course->with(['videos']);
    }
}
