<?php

namespace App\Actions\Mentor;

use App\Models\Mentor;

/**
 *
 */
class CreateMentorAction
{
    /**
     * @param array $data
     * @return Mentor
     */
    public function execute(array $data): Mentor
    {
        return Mentor::create($data);
    }
}
