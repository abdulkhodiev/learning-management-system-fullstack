<?php

namespace App\Actions\Category;

use App\Models\Category;

class GetAllCategoriesAction
{
    public function execute()
    {
        return Category::all();
    }
}
