<?php

namespace App\Actions\Course\Tabs\Chapters;

use App\Models\CourseChapter;

class DestroyChapterAction
{
    /**
     * Delete the given chapter.
     *
     * @param  CourseChapter  $courseChapter
     * @return void
     */
    public function execute(CourseChapter $courseChapter): void
    {
        $courseChapter->delete();
    }
}
