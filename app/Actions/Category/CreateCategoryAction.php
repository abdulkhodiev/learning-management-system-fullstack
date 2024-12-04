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
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile && $data['icon']->isValid()) {
            $filePath = $data['icon']->storeAs(
                'categories/' . now()->format('Y/m/d'),
                uniqid() . '.' . $data['icon']->getClientOriginalExtension(),
                'public'
            );

            $data['icon'] = Storage::url( $filePath);
        }

        return Category::create($data);
    }
}

