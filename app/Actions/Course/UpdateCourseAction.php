<?php

namespace App\Actions\Course;

use App\Models\Course;

class UpdateCourseAction
{
    public function execute(Course $course, array $data): Course
    {
       return $course->update;

    }
}
