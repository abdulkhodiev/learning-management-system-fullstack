<?php

namespace App\Http\Controllers;

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

    public function index(GetAllCommissionsAction   $getAllCommissionsAction, GetCommissionsGraphDataAction $getCommissionsGraphDataAction): Response
    {
        $commissions = $getAllCommissionsAction->execute();
        $graph_data = $getCommissionsGraphDataAction->execute();
        return Inertia::render('Dashboard/Index', [
            'commissions' => $commissions,
            'graph_data' => $graph_data,
        ]);
    }
}
