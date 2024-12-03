<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *\
     * @return array
     */
    public function rules()
    {
        $categoryId = $this->route('category')->id;

        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $categoryId],
            'icon' => ['nullable', 'file', 'mimes:jpeg,jpg,png,svg,webp', 'max:2048'],
        ];
    }
}
