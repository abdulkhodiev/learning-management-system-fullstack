<?php

namespace App\Actions\Mentor;

use App\Models\Mentor;

class UpdateMentorAction
{
    public function execute(?Mentor $mentor, array $data): Mentor
    {
        if ($mentor) {
            $mentor->update($data);
            return $mentor;
        }

        return Mentor::create($data);
    }

}
