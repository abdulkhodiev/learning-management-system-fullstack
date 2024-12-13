<?php

namespace App\Actions\Course\Tabs\Lessons;

use App\Models\Lesson;

class DestroyLessonAction
{
    public function execute(Lesson $lesson): void
    {
        $lesson->delete();
    }
}
