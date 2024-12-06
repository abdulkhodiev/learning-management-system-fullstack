<?php

namespace App\Http\Controllers\CourseControllers;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

use Inertia\Response;
use Illuminate\Http\RedirectResponse;


class CourseCommissionController extends Controller
{
    /**
     * @return \Inertia\Response
     */

    //  $courses = Course::with(['students' => function ($query) {
    //     $query->select('users.id', 'users.first_name', 'users.last_name')
    //           ->withPivot('price', 'purchased_at');
    // }])->get();

    // $commissions = [];

    // foreach ($courses as $course) {
    //     $totalEarnings = $course->students->sum(function ($student) {
    //         return $student->pivot->price;
    //     });

    //     $commissions[] = [
    //         'course_title' => $course->title,
    //         'total_students' => $course->students->count(),
    //         'total_earnings' => $totalEarnings,
    //         'mentor' => $course->mentor->name ?? 'Unknown', // Mentor name if available
    //     ];
    // }

    // return Inertia::render('CourseCommission', [
    //     'commissions' => $commissions
    // ]);
    public function index(): Response
    {
        return Inertia::render('Courses/Tabs/Commissions/Index' );

    }
}
