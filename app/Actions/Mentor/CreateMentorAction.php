<?php

namespace App\Actions\Mentor;

use App\Models\Mentor;

class CreateMentorAction
{
    public function execute(array $data): Mentor
    {
        return Mentor::create($data);
    }
}
