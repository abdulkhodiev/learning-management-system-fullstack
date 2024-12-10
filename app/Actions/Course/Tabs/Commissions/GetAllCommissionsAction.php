<?php

namespace App\Actions\Course\Tabs\Commissions;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GetAllCommissionsAction
{

    /**
     * @param int $courseId
     * @return array
     * @throws \Exception
     */

    public function execute(int $courseId): array
    {
        $course = Course::find($courseId);
        if (!$course) {
            throw new \Exception('Course not found.');
        }

        $pivotRecords = DB::table('course_student')
            ->where('course_id', $courseId)
            ->get();

        if ($pivotRecords->isEmpty()) {
            return [];
        }

        $result = $pivotRecords->map(function ($pivotRecord) {
            $user = User::find($pivotRecord->student_id);

            if (!$user) {
                return null;
            }

            return [
                'order_id' => $pivotRecord->id,
                'customer' => $user->first_name . ' ' . $user->last_name,
                'type' => $user->role->name ?? 'Unknown',
                'date' => $pivotRecord->created_at,
                'status' => $pivotRecord->status ?? 'Pending',
                'commission' => $pivotRecord->commission ?? 0,
            ];
        });

        return $result->filter()->toArray();
    }


}
