<?php

namespace App\Actions\Course;

use App\Models\Course;
use App\Models\Mentor; // Ensure this is imported
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class CreateCourseAction
{
    /**
     * Creates a new course based on the given data.
     *
     * This method also takes care of associating the mentor with the course.
     *
     * @param array $data The data used to create the course. The keys expected are:
     *                    - title
     *                    - description
     *                    - price
     *                    - category_id
     *                    - languages
     *                    - image (optional)
     *
     * @return Course The newly created course.
     *
     * @throws \Exception If the mentor does not exist in the database.
     */
    public function execute(array $data): Course
    {
        $mentor = Auth::user();

        // Ensure mentor exists in the database
        if (!Mentor::find($mentor->id)) {
            throw new \Exception('Mentor not found. Please ensure the mentor exists in the database.');
        }

        $data['mentor_id'] = $mentor->id;

        if (isset($data['image']) && $data['image'] instanceof UploadedFile && $data['image']->isValid()) {
            $filePath = $data['image']->storeAs(
                'courses/' . now()->format('Y/m/d'),
                uniqid() . '.' . $data['image']->getClientOriginalExtension(),
                'public'
            );
            $data['image'] = Storage::url($filePath);
        }
        return Course::create($data);
    }
}
