<?php

namespace App\Http\Controllers\CourseControllers;

use App\Actions\Category\GetAllCategoriesAction;
use App\Actions\Course\CreateCourseAction;
use App\Actions\Course\DestroyCourseAction;
use App\Actions\Course\GetAllCoursesAction;
use App\Actions\Course\UpdateCourseAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Models\Course;
use Inertia\Inertia;

use Inertia\Response;
use Illuminate\Http\RedirectResponse;


class CourseController extends Controller
{

    /**
     * @param GetAllCoursesAction $action
     * @return \Inertia\Response
     */
    public function index(GetAllCoursesAction $action): Response
    {
        $courses = $action->execute();

        return Inertia::render('Courses/Index', ['courses' => $courses] );
    }

    /**
     * @param GetAllCategoriesAction $categoryAction
     * @return \Inertia\Response
     */
    public function create(GetAllCategoriesAction $categoryAction): Response
    {
        $categories = $categoryAction->execute();

        return Inertia::render('Courses/CreateEdit', ['categories' => $categories]);
    }


    /**
     * @param CreateCourseAction $action
     * @param CreateCourseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CreateCourseAction $action, CreateCourseRequest $request): RedirectResponse
    {

        $action->execute($request->validated());

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * @param GetAllCategoriesAction $action
     * @param Course $course
     * @return \Inertia\Response
     */
    public function edit(GetAllCategoriesAction $action, Course $course): Response
    {
        $categories = $action->execute();

        return Inertia::render('Courses/CreateEdit', ['categories'=> $categories, 'course' => $course ]);
    }

    /**
     * @param UpdateCourseAction $action
     * @param UpdateCourseRequest $updateCourseRequest
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCourseAction $action, UpdateCourseRequest $updateCourseRequest, Course $course): RedirectResponse
    {

        $action->execute($course, $updateCourseRequest->validated());

        return redirect()->route('courses.index')->with('success','Course updated successfully.');
    }

    /**
     * @param DestroyCourseAction $action
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyCourseAction $action, Course $course): RedirectResponse
    {
        $action->execute($course);

        return redirect()->route('courses.index')->with('success','Course deleted successfully.');
    }


}
