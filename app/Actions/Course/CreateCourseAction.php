<?php

namespace App\Actions\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;



class CreateCourseAction
{


    /**
     * @param array $data
     * @return Course
     * @throws \Exception
     */
    public function execute(array $data): Course
    {


        $mentor = Auth::user()->mentor;

        if (!$mentor) {
            throw new \Exception('Mentor not found or the authenticated user is not a mentor.');
        }

        // Handle image upload if provided
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            if (!$data['image']->isValid()) {
                throw new \Exception('Invalid image file.');
            }

            $filePath = $data['image']->storeAs(
                'courses/' . now()->format('Y/m/d'),
                uniqid('course_', true) . '.' . $data['image']->getClientOriginalExtension(),
                'public'
            );

            $data['image'] = Storage::url($filePath);
        }

        $course = new Course($data);
        $mentor->courses()->save($course);

        return $course;
    }
}
