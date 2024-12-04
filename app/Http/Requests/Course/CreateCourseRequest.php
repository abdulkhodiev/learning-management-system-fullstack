<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'numeric'],
            'mentor_id' => [ 'numeric'],
            'price' => ['required', 'numeric'],
            'languages'=> ['array', 'required', 'min:1'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

        ];
    }
}
