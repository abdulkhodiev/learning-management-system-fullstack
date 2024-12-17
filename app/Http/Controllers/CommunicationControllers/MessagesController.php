<?php

namespace App\Http\Controllers\CommunicationControllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class MessagesController extends Controller
{
    /**
     * Displays the messages index page.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Communication/Messages/Index');
    }
}
