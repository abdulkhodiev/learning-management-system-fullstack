<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{

    /**
     * @return true
     */
    public function authorize()

    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'numeric'],
            'mentor_id' => [ 'numeric'],
            'price' => ['required', 'numeric'],
            'languages'=> ['array', 'required', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

        ];
    }
}
