<?php

namespace App\Actions\Mentor;

use App\Models\Mentor;

class DestroyMentorAction
{
    public function execute(Mentor $mentor): void
    {
        $mentor->delete();
    }
}
