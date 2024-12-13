<?php

namespace App\Http\Requests\Course\Tabs\Lessons;


use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'string', 'max:255'],
            'video_url' => ['required', 'string', 'min:0'],
            'priority' => ['required', 'string', 'min:0'],
            'course_chapter_id' => ['required', 'exists:course_chapters,id'],
        ];
    }
}
