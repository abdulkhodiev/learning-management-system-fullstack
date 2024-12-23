<?php

namespace App\Http\Controllers\CommunicationControllers;

use App\Actions\Communication\Messages\GetAllStudentsAction;
use App\Actions\Communication\Messages\GetChatWithMessages;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class MessagesController extends Controller
{
    /**
     * Displays the messages index page.
     *
     * @return Response
     */
    public function index(GetAllStudentsAction $getAllStudentsAction): Response
    {
        $students = $getAllStudentsAction->execute();
        return Inertia::render('Communication/Messages/Layout', [
            'students' => $students
        ]);
    }

    public function chat_index(GetChatWithMessages $getChatWithMessages,  User $user): Response
    {
        $chatWithMessages = $getChatWithMessages->execute($user);

        return Inertia::render('Communication/Messages/Chat', [
            'chat' => $chatWithMessages
        ]);
    }
}
