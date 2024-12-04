<?php

namespace App\Actions\Course;

use App\Models\Course;

class GetAllCoursesAction
{
    /**
     * Returns all courses.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Course[]
     */
    public function execute()
    {
        return Course::all();
    }
}
