<?php

namespace App\Http\Controllers\CourseControllers;
use App\Http\Controllers\Controller;
use Inertia\Inertia;



class CourseCommissionController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Courses/Tabs/Commissions/Index' );

    }
}
