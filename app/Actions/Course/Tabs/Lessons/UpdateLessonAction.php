<?php

namespace App\Actions\Course\Tabs\Lessons;

use App\Models\Lesson;

class UpdateLessonAction
{

    /**
     * Updates the given lesson with the provided data.
     *
     * @param Lesson $lesson The lesson instance to be updated.
     * @param array $data The data to update the lesson with.
     * @return Lesson The updated lesson instance.
     */
    public function execute(Lesson $lesson, array $data): Lesson
    {
        $lesson->update($data);

        return $lesson;
    }
}
