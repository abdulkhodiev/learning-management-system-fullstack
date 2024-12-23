<?php

namespace App\Actions\Course\Tabs\Chapters;

use App\Models\CourseChapter;

class UpdateChapterAction
{

    /**
     * Updates the given course chapter with the provided data.
     *
     * @param CourseChapter $courseChapter The course chapter instance to be updated.
     * @param array $data The data to update the course chapter with.
     * @return void
     */

    public function execute( array $data): void
    {
        CourseChapter::find($data['course_id'])->update($data);
    }
}
