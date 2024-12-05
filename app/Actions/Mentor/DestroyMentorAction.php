<?php

namespace App\Actions\Mentor;

use App\Models\Mentor;

/**
 *
 */
class DestroyMentorAction
{
    /**
     * @param Mentor $mentor
     * @return void
     */
    public function execute(Mentor $mentor): void
    {
        $mentor->delete();
    }
}
