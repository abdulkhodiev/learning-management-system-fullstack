<?php

namespace App\Actions\Course\Tabs\Lessons;

use App\Models\Lesson;

class GetAllLessonsAction
{
/**
 * Retrieves all lessons for the specified chapter.
 *
 * @param string $chapterId The ID of the chapter whose lessons are to be retrieved.
 * @return array An array of lessons associated with the given chapter ID.
 */
    public function execute(string $chapterId): array
    {
        $lessons = Lesson::where('course_chapter_id', $chapterId)->get();

        return $lessons->toArray();

    }
}
