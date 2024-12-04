<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UpdateCategoryAction
{
    /**
     * Execute the category update action.
     *
     * @param  Category $category
     * @param  array    $data
     * @return Category
     */
    public function execute(Category $category, array $data): Category
    {
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile && $data['icon']->isValid()) {
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }

            $filePath = $data['icon']->storeAs(
                'categories/' . now()->format('Y/m/d'),
                uniqid() . '.' . $data['icon']->getClientOriginalExtension(),
                'public'
            );

            // Set the new file path in data
            $data['icon'] = Storage::url($filePath);
        }

        // Update the category with the remaining data
        $category->update($data);

        return $category;
    }
}
