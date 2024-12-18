<?php

namespace App\Http\Controllers\CommunicationControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class NotificationsController extends Controller
{

    /**
     * Displays the notifications index page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('Communication/Notifications/Index');
    }
}
