<?php

namespace App\Actions\Course;

use App\Models\Course;

class UpdateCourseAction
{
    /**
     * Updates a course with the given data.
     *
     * @param Course $course The course to be updated.
     * @param array $data The data to update the course with.
     *
     * @return Course The updated course.
     */
    public function execute(Course $course, array $data): Course
    {
       return $course->update;
    }
}
