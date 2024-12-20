<?php

namespace App\Actions\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class GetAllCommissionsAction
    {
    /**
     * Executes the action to retrieve commission details for all courses.
     *
     * This function fetches all user commission records from the database,
     * calculates and returns various commission summaries including lifetime,
     * received, and pending commissions.
     *
     * @return array An array containing commission data and summaries:
     *               - 'data': an array of all user commission details grouped by courses.
     *               - 'lifetime_commissions': total amount of all commissions.
     *               - 'lifetime_received_commissions': total of received commissions.
     *               - 'lifetime_pending_commissions': total of pending commissions.
     */
    public function execute(): array
    {
        $pivotRecords = DB::table('course_user')->get();

        if ($pivotRecords->isEmpty()) {
            return [];
        }

        $result = $pivotRecords->map(function ($pivotRecord) {
            $user = User::find($pivotRecord->user_id);

            if (!$user) {
                return null;
            }

            return [
                'course_id' => $pivotRecord->course_id,
                'order_id' => $pivotRecord->id,
                'customer' => $user->first_name . ' ' . $user->last_name,
                'type' => $user->role->name ?? 'Unknown',
                'date' => $pivotRecord->created_at,
                'status' => $pivotRecord->status ?? 'Pending',
                'commission' => $pivotRecord->commission ?? 0,
            ];
        });

        $filteredResult = $result->filter();


        $lifeTimeCommissions = $filteredResult->sum('commission');

        $lifeTimeReceivedCommissions = $filteredResult->sum(function ($item) {
            return $item['status'] === 'received' ? $item['commission'] : 0;
        });

        $lifeTimePendingCommissions = $filteredResult->sum(function ($item) {
            return $item['status'] === 'pending' ? $item['commission'] : 0;
        });

        return [
            'lifetime_commissions' => $lifeTimeCommissions,
            'lifetime_received_commissions' => $lifeTimeReceivedCommissions,
            'lifetime_pending_commissions' => $lifeTimePendingCommissions
        ];
    }
}
