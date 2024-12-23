<?php

namespace App\Actions\Communication\Messages;

use App\Models\Chat;

class CreateChatAction
{
    public function execute()
    {
        return Chat::create();
    }
}
