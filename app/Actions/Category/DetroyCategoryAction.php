<?php

namespace App\Actions\Category;

use App\Models\Category;

class DetroyCategoryAction
{
    /**
     * Execute the category deletion action.
     *
     * @param  Category $category
     * @return void
     */
    public function execute(Category $category): void
    {
        $category->delete();
    }
}
