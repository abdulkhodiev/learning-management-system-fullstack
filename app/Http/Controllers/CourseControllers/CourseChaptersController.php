<?php

namespace App\Http\Controllers\CourseControllers;

use App\Actions\Course\Tabs\Chapters\CreateChapterAction;
use App\Actions\Course\Tabs\Chapters\DestroyChapterAction;
use App\Actions\Course\Tabs\Chapters\GetAllChaptersAction;
use App\Actions\Course\Tabs\Chapters\UpdateChapterAction;
use App\Http\Requests\Course\Tabs\Chapters\CreateChapterRequest;
use App\Http\Requests\Course\Tabs\Chapters\UpdateChapterRequest;
use App\Models\CourseChapter;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;


class CourseChaptersController extends Controller
{

    /**
     * Retrieve all chapters for a given course.
     *
     * @param GetAllChaptersAction $action
     * @param int $courseId The ID of the course whose chapters are to be retrieved.
     * @return \Inertia\Response
     */
    public function index(GetAllChaptersAction $action, int $courseId): Response
    {
        $chapters = $action->execute($courseId);
        return Inertia::render('Courses/Tabs/Chapters/Index',
        ['chapters' => $chapters]);
    }


    /**
     * Store a newly created chapter in storage.
     *
     * @param CreateChapterAction $action
     * @param CreateChapterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(
        CreateChapterAction $action,
        CreateChapterRequest $request
        ): RedirectResponse{
        $action->execute($request->validated());

        return redirect()->route('course.chapters.index',
        ['course' => $request->course_id])
        ->with('success', 'Chapter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseChapter  $courseChapter
     * @return \Inertia\Response
     */
    public function edit(CourseChapter $courseChapter): Response
    {

        return Inertia::render('Courses/Tabs/Chapters/Index',
        ['chapter' => $courseChapter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Actions\Course\Tabs\Chapters\UpdateChapterAction  $action
     * @param  \App\Http\Requests\Course\Tabs\Chapters\UpdateChapterRequest  $request
     * @param  \App\Models\CourseChapter  $courseChapter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        UpdateChapterAction $action,
        UpdateChapterRequest $request,
        CourseChapter $courseChapter
        ): RedirectResponse {

      $action->execute($courseChapter, $request->validated());

        return redirect()->route('course.chapters.index',
        ['course' => $request->course_id])
            ->with('success', 'Chapter updated successfully.');
    }

    /**
     * Delete the specified chapter.
     *
     * @param  \App\Models\CourseChapter  $courseChapter
     * @param  \App\Actions\Course\Tabs\Chapters\DestroyChapterAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(
        DestroyChapterAction $action,
        CourseChapter $courseChapter
        ): RedirectResponse{
        $action->execute($courseChapter);

        return redirect()->route('course.chapters.index',
        ['course' => $courseChapter->course_id])
            ->with('success', 'Chapter deleted successfully.');
    }

}
