<?php

namespace App\Actions\Course;

use App\Models\Course;


class DestroyCourseAction
{
    public function execute(Course $course): void
    {
        $course->delete();
    }
}
