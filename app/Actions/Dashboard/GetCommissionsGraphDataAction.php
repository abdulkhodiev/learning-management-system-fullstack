<?php

namespace App\Actions\Dashboard;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GetCommissionsGraphDataAction
{
    /**
     * Executes the action to generate data for the graph of lifetime commissions over time.
     *
     * The data will be grouped by month, summing up commissions for all courses.
     *
     * @return array An array of graph data with:
     *               - 'labels': months (e.g., ['Jan', 'Feb', ..., 'Dec']).
     *               - 'lifetime_commissions': total commissions for each month.
     *               - 'received_commissions': received commissions for each month.
     *               - 'pending_commissions': pending commissions for each month.
     */
    public function execute(): array
    {
        // Get the current year for the graph data
        $currentYear = Carbon::now()->year;

        // Fetch data grouped by month
        $monthlyCommissions = DB::table('course_user')
            ->selectRaw('EXTRACT(MONTH FROM created_at) as month,
                         SUM(commission) as total_commissions,
                         SUM(CASE WHEN status = \'received\' THEN commission ELSE 0 END) as received_commissions,
                         SUM(CASE WHEN status = \'pending\' THEN commission ELSE 0 END) as pending_commissions')
            ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [$currentYear]) // Filter by the current year
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare graph data
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::createFromDate(null, $month)->format('M'); // Get short month name
        });

        $lifetimeCommissions = [];
        $receivedCommissions = [];
        $pendingCommissions = [];

        foreach ($months as $index => $month) {
            $monthData = $monthlyCommissions->firstWhere('month', $index + 1);

            $lifetimeCommissions[] = $monthData->total_commissions ?? 0;
            $receivedCommissions[] = $monthData->received_commissions ?? 0;
            $pendingCommissions[] = $monthData->pending_commissions ?? 0;
        }

        return [
            'labels' => $months->toArray(),
            'lifetime_commissions' => $lifetimeCommissions,
            'received_commissions' => $receivedCommissions,
            'pending_commissions' => $pendingCommissions,
        ];
    }
}
