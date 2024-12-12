<?php

namespace App\Http\Controllers\CourseControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;


class CourseChapterLessonController extends Controller
{
    /**
     * Displays the page for all lessons within a given chapter.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
    return Inertia::render('Courses/Tabs/Chapters/Lessons/Index');
    }
}
