<?php

namespace App\Http\Controllers\CourseControllers;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

use Inertia\Response;
use Illuminate\Http\RedirectResponse;


class CourseReviewsController extends Controller
{

    /**
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('Courses/Tabs/Reviews/Index' );

    }
}
