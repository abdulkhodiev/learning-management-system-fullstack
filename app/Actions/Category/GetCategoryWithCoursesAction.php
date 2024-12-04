<?php

namespace App\Actions\Category;

use App\Models\Category;

class GetCategoryWithCoursesAction
{
    /**
     * Load the courses for the given category.
     *
     * @param  Category  $category
     * @return Category
     */
    public function execute(Category $category)
    {
        return $category->load('courses');
    }
}
