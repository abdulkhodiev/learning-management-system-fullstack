<?php

namespace App\Actions\Course;

use App\Models\Course;


class DestroyCourseAction
{
    /**
     * Delete the given course.
     *
     * @param  Course  $course
     * @return void
     */
    public function execute(Course $course): void
    {
        $course->delete();
    }
}
