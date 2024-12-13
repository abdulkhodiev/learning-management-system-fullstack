<?php

namespace App\Actions\Course\Tabs\Lessons;

use App\Models\Lesson;

class CreateLessonAction
{
    /**
     * Creates a new lesson based on the given data.
     *
     * @param array $data The data to create the lesson with.
     *
     * @return Lesson The newly created lesson instance.
     */
    public function execute(array $data): Lesson
    {
        $lesson = Lesson::create($data);

        return $lesson;
    }
}
