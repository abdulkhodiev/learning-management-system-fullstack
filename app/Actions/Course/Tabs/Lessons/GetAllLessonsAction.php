<?php

namespace App\Actions\Course\Tabs\Lessons;

use App\Models\Lesson;

class GetAllLessonsAction
{
    public function execute(string $chapterId): array
    {
        $lessons = Lesson::where('course_chapter_id', $chapterId)->get();

        return $lessons->toArray();

    }
}
