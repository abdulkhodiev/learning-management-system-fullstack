<?php

namespace App\Actions\Category;

use App\Models\Category;

class GetAllCategoriesAction
{
    /**
     * Get all categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function execute()
    {
        return Category::all();
    }
}
