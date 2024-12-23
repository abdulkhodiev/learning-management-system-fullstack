<?php

namespace App\Http\Controllers;

use App\Actions\Course\GetAllCoursesAction;
use App\Actions\Dashboard\GetAllReviewsAction;
use App\Actions\Dashboard\GetCommissionsGraphDataAction;
use App\Actions\Dashboard\GetAllCommissionsAction;

use Inertia\Inertia;
use Inertia\Response;


class DashboardController extends Controller
{
/**
 * Displays the dashboard with commission details and graph data.
 *
 * @param GetAllCommissionsAction $getAllCommissionsAction
 * @param GetCommissionsGraphDataAction $getCommissionsGraphDataAction
 * @return Response
 */

    public function index(GetAllCommissionsAction   $getAllCommissionsAction, GetCommissionsGraphDataAction $getCommissionsGraphDataAction, GetAllReviewsAction $getAllReviewsAction, GetAllCoursesAction $getAllCoursesAction): Response
    {
        $commissions = $getAllCommissionsAction->execute();
        $graph_data = $getCommissionsGraphDataAction->execute();
        $reviews = $getAllReviewsAction->execute();
        $courses = $getAllCoursesAction->execute();
        return Inertia::render('Dashboard/Index', [
            'commissions' => $commissions,
            'graph_data' => $graph_data,
            'reviewsInfo' => $reviews,
            'courses' => $courses
        ]);
    }
}
