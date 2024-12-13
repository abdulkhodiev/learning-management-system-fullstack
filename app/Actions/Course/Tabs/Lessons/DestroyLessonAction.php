<?php

namespace App\Actions\Course\Tabs\Lessons;

use App\Models\Lesson;

class DestroyLessonAction
{
    /**
     * Deletes a lesson.
     *
     * @param Lesson $lesson The lesson to be deleted.
     */
    public function execute(Lesson $lesson): void
    {
        $lesson->delete();
    }
}
