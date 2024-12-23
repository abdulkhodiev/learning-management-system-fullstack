<?php

namespace App\Actions\Communication\Messages;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetChatWithMessages
{
    /**
     * Load the messages relationship for the given user.
     *
     * @param User $user The user instance for which to load the chat and messages.
     * @return Chat The chat instance with its messages loaded.
     * @throws ModelNotFoundException If the chat is not found for the given user.
     */
    public function execute(User $user)
    {
       if (!$user->chat) {
            throw new ModelNotFoundException('Chat not found for the given user.');
        }
        $chat = Chat::where('user_id', $user->id)->firstOrFail();

        // Load the messages relationship
        return $chat->load('messages');
    }
}
