<?php

namespace App\Actions\Category;

use App\Models\Category;

class DetroyCategoryAction
{
    public function execute(Category $category): void
    {
        $category->delete();
    }
}
