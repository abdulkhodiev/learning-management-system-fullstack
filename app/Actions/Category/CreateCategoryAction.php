<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class CreateCategoryAction
{
    /**
     * Execute the category creation action.
     *
     * @param  array $data
     * @return Category
     */
    public function execute(array $data): Category
    {
        // Check if 'icon' exists and is a valid uploaded file
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile && $data['icon']->isValid()) {
            // Store the icon file
            $filePath = $data['icon']->storeAs(
                'categories/' . now()->format('Y/m/d'),
                uniqid() . '.' . $data['icon']->getClientOriginalExtension(),
                'public'
            );

            // Update 'icon' path in the data array
            $data['icon'] = $filePath;
        }

        // Create and return the new category
        return Category::create($data);
    }
}

