<?php

namespace App\Http\Controllers\CourseControllers;

use App\Actions\Course\Tabs\Lessons\CreateLessonAction;
use App\Actions\Course\Tabs\Lessons\DestroyLessonAction;
use App\Actions\Course\Tabs\Lessons\GetAllLessonsAction;
use App\Actions\Course\Tabs\Lessons\UpdateLessonAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\Tabs\Lessons\CreateLessonRequest;
use App\Http\Requests\Course\Tabs\Lessons\UpdateLessonRequest;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;



class CourseChapterLessonController extends Controller
{

    /**
     * Get all lessons for the given chapter.
     *
     * @param GetAllLessonsAction $action
     * @param string $chapterId
     * @return Response
     */
    public function index(GetAllLessonsAction $action, string $chapterId): Response
    {
        $lessons = $action->execute($chapterId);

        return Inertia::render('Courses/Tabs/Chapters/Lessons/Index' ,
        ['lessons' => $lessons]);
    }

    /**
     * Displays the page for creating a new lesson.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Courses/Tabs/Chapters/Lessons/CreateEdit');
    }


    /**
     * Stores a newly created lesson in storage.
     *
     * @param CreateLessonAction $action
     * @param CreateLessonRequest $request
     * @return RedirectResponse
     */
    public function store(
        CreateLessonAction $action,
        CreateLessonRequest $request
    ): RedirectResponse {
        $action->execute($request->validated());

        // Retrieve the correct route parameters
        $course = $request->route('courseId');
        $chapter = $request->route('chapterId');

        return redirect()->route('course.chapters.lessons.index', [
            'courseId' => $course,
            'chapterId' => $chapter,
        ]);
    }


    /**
     * Displays the edit page for a specific lesson.
     *
     * @param Lesson $lesson The lesson instance to be edited.
     * @return Response The Inertia response rendering the lesson edit page.
     */
    public function edit(Lesson $lesson): Response
    {

        return Inertia::render('Courses/Tabs/Chapters/Lessons/CreateEdit',
        ['lesson' => $lesson,]);
    }

    /**
     * Updates a lesson.
     *
     * @param Lesson $lesson The lesson instance to be updated.
     * @param UpdateLessonAction $action The action to update the lesson with.
     * @param UpdateLessonRequest $request The request containing the data to update the lesson with.
     *
     * @return \Illuminate\Http\RedirectResponse A redirect response to the lessons page.
     */
    public function update(
        Lesson $lesson,
        UpdateLessonAction $action,
        UpdateLessonRequest $request
    ): RedirectResponse {
        $action->execute($request->validated(), $lesson->id);

        // Retrieve the correct route parameters
        $course = $request->route('course');
        $chapter = $request->route('chapter');

        return redirect()->route('course.chapters.lessons.index',[
            'courseId' => $course,
            'chapterId' => $chapter,
        ]);
    }

    /**
     * Deletes a lesson.
     *
     * @param Lesson $lesson The lesson to be deleted.
     */
    public function destroy(Lesson $lesson, DestroyLessonAction $action): void
    {
        $action->execute($lesson);
    }



}
