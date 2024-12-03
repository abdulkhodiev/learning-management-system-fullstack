<?php

namespace App\Actions\Course;

use App\Models\Course;

class CreateCourseAction
{

    public function execute(array $data): Course
    {
        return Course::create($data);
    }

}
