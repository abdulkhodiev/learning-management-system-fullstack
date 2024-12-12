<?php

namespace App\Actions\Course\Tabs\Chapters;

use App\Models\CourseChapter;

class GetAllChaptersAction
{
/**
 * Retrieves all chapters for the specified course.
 *
 * @param int $courseId The ID of the course whose chapters are to be retrieved.
 * @return array An array of chapters associated with the given course ID.
 */
    public function execute(int $courseId): array
    {
        return CourseChapter::where('course_id', $courseId)->get()->toArray();
    }
}
