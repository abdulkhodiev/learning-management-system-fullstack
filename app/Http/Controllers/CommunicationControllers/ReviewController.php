<?php

namespace App\Http\Controllers\CommunicationControllers;

use App\Actions\Communication\Reviews\GetAllReviewsAction;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ReviewController extends Controller
{
    /**
     * Displays the reviews index page.
     *
     * @return Response
     */
    public function index(GetAllReviewsAction $getAllReviewsAction): Response
    {
        $reviews = $getAllReviewsAction->execute();
        return Inertia::render('Communication/Reviews/Index', [
            'reviews' => $reviews
        ]);
    }
}
