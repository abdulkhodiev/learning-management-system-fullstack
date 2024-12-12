<?php

namespace App\Actions\Course\Tabs\Chapters;

use App\Models\CourseChapter;

class CreateChapterAction
{
    /**
     * Creates a new course chapter with the provided data.
     *
     * @param array $data The data to create the chapter with.
     * @return void
     */

    public function execute(array $data): void
    {
        CourseChapter::create($data);
    }
}
