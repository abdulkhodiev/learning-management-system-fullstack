<?php

namespace App\Actions\Course\Tabs\Chapters;

use App\Models\CourseChapter;

class UpdateChapterAction
{
    /**
     * Updates the given chapter with the provided data.
     *
     * @param CourseChapter $courseChapter The chapter instance to be updated.
     * @param array $data The data to update the chapter with.
     * @return CourseChapter The updated chapter instance.
     */
    public function execute(CourseChapter $courseChapter, array $data):CourseChapter
    {
        $courseChapter->update($data);
        return $courseChapter;
    }
}
