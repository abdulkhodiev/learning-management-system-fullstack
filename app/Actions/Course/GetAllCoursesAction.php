<?php

namespace App\Actions\Course;

use App\Models\Course;

class GetAllCoursesAction
{
    public function execute()
    {
        return Course::all();
    }
}
