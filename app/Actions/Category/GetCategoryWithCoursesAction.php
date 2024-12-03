<?php

namespace App\Actions\Category;

use App\Models\Category;

class GetCategoryWithCoursesAction
{
    public function execute(Category $category)
    {
        return $category->load('courses');
    }
}
