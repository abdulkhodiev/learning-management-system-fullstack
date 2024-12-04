<?php

namespace App\Http\Controllers;

use App\Actions\Category\GetAllCategoriesAction;
use App\Actions\Course\CreateCourseAction;
use App\Actions\Course\GetAllCoursesAction;
use App\Http\Requests\Course\CreateCourseRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Actions\Course\GetAllCoursesAction  $action
     * @return \Inertia\Response
     */
    public function index(GetAllCoursesAction  $action)
    {
        $courses = $action->execute();
        return Inertia::render('Courses/Index', ['courses' => $courses] );
    }

    /**
     * Show the form for creating a new course.
     *
     * @param  \App\Actions\Category\GetAllCategoriesAction  $categoryAction
     * @return \Inertia\Response
     */
    public function create(GetAllCategoriesAction $categoryAction)
    {
        $categories = $categoryAction->execute();
        return Inertia::render('Courses/CreateEdit', ['categories' => $categories]);
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  \App\Actions\Course\CreateCourseAction  $action
     * @param  \App\Http\Requests\Course\CreateCourseRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCourseAction $action, CreateCourseRequest $request)
    {

        $action->execute($request->validated());
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }


}
