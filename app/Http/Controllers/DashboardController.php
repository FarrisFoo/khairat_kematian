<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get registered users by month (total cumulative)
        $registeredUsers = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count'),
            DB::raw('MAX(created_at) as month_date')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->keyBy('month');

        // Get new registered users by month
        $newUsers = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Prepare data for all months
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mac', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Ogos',
            9 => 'Sept', 10 => 'Okt', 11 => 'Nov', 12 => 'Dis'
        ];

        $registeredData = [];
        $newUsersData = [];
        $cumulativeCount = 0;

        foreach ($months as $monthNum => $monthName) {
            // Registered users (cumulative)
            if (isset($registeredUsers[$monthNum])) {
                $cumulativeCount += $registeredUsers[$monthNum]->count;
            }
            $registeredData[] = $cumulativeCount;

            // New users
            $newUsersData[] = $newUsers[$monthNum]->count ?? 0;
        }

        return view('admin.dashboard', [
            'months' => array_values($months),
            'registeredData' => $registeredData,
            'newUsersData' => $newUsersData
        ]);
    }
}
