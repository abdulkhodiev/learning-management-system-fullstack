<?php

namespace App\Actions\Course;

use App\Models\Course;

class UpdateCourseAction
{

/**
 * Updates the given course with the provided data.
 *
 * @param Course $course The course instance to be updated.
 * @param array $data The data to update the course with.
 * @return Course The updated course instance.
 */
    public function execute(Course $course, array $data): Course
    {
        $course->update($data);
        return $course;
    }
}
