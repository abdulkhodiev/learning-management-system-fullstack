<?php

namespace App\Actions\Mentor;

use App\Models\Mentor;


class UpdateMentorAction
{
    /**
     * @param Mentor|null $mentor
     * @param array $data
     * @return Mentor
     */
    public function execute(?Mentor $mentor, array $data): Mentor
    {
        if ($mentor) {
            $mentor->update($data);
            return $mentor;
        }

        return Mentor::create($data);
    }

}
