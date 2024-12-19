<?php

namespace App\Actions\Course\Tabs\Commissions;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GetAllCommissionsAction
{


/**
 * Executes the action to retrieve all commission details for a given course.
 *
 * This function fetches the course by its ID and retrieves associated user
 * commission records from the database. It calculates and returns various
 * commission summaries, including lifetime, received, and pending commissions.
 *
 * @param int $courseId The ID of the course to retrieve commissions for.
 * @return array An array containing commission data and summaries:
 *               - 'data': an array of user commission details.
 *               - 'lifetime_commissions': total amount of all commissions.
 *               - 'lifetime_received_commissions': total of received commissions.
 *               - 'lifetime_pending_commissions': total of pending commissions.
 * @throws \Exception if the course is not found.
 */

    public function execute(int $courseId): array
    {
        $course = Course::find($courseId);
        if (!$course) {
            throw new \Exception('Course not found.');
        }

        $pivotRecords = DB::table('course_user')
            ->where('course_id', $courseId)
            ->get();

        if ($pivotRecords->isEmpty()) {
            return [];
        }



        $result = $pivotRecords->map(function ($pivotRecord) {
            $user = User::find($pivotRecord->user_id);

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

        $filteredResult = $result->filter();

        // Calculate lifetime commissions
        $lifeTimeCommissions = $filteredResult->sum(function ($item) {
            return $item['commission']; // Extract the 'commission' field for summing
        });

        $lifeTimeReceivedCommissions = $filteredResult->sum(function ($item) {
            return $item['status'] === 'received' ? $item['commission'] : 0;
        });

        $lifeTimePendingCommissions = $filteredResult->sum(function ($item) {
            return $item['status'] === 'pending' ? $item['commission'] : 0;
        });

        return [
            'data' => $filteredResult->toArray(),
            'lifetime_commissions' => $lifeTimeCommissions,
            'lifetime_received_commissions' => $lifeTimeReceivedCommissions,
            'lifetime_pending_commissions' => $lifeTimePendingCommissions
        ];

    }


}
