<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Dana;
use App\Models\Tuntutan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function ahli()
    {
        // Daily registration data
        $dailyData = Member::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Monthly registration data
        $monthlyData = Member::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();


        // Yearly registration data
        $yearlyData = Member::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('count(*) as total')
        )
        ->groupBy('year')
        ->orderBy('year')
        ->get();


        return view('laporan.ahli', compact('dailyData', 'monthlyData', 'yearlyData'));
    }

    public function danaMasuk()
    {
        // Daily payment data
        $dailyData = Dana::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(jumlah) as total')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Monthly payment data
        $monthlyData = Dana::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(jumlah) as total')
        )
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        // Yearly payment data
        $yearlyData = Dana::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(jumlah) as total')
        )
        ->groupBy('year')
        ->orderBy('year')
        ->get();

        // Payment methods breakdown
        $paymentMethods = Dana::select(
            'kaedah_bayaran',
            DB::raw('SUM(jumlah) as total'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('kaedah_bayaran')
        ->get();

        return view('laporan.dana-masuk', compact(
            'dailyData',
            'monthlyData',
            'yearlyData',
            'paymentMethods'
        ));
    }

    public function danaKeluar()
    {
        // Get all approved claims
        $approvedClaims = Tuntutan::where('status', 'diluluskan')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // Monthly approved claims data
        $monthlyData = Tuntutan::select(
            DB::raw('YEAR(updated_at) as year'),
            DB::raw('MONTH(updated_at) as month'),
            DB::raw('CONCAT(YEAR(updated_at), "-", MONTH(updated_at)) as month_year'),
            DB::raw('SUM(jumlah_diluluskan) as total')
        )
        ->where('status', 'diluluskan')
        ->groupBy('year', 'month', 'month_year')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        // Yearly approved claims data
        $yearlyData = Tuntutan::select(
            DB::raw('YEAR(updated_at) as year'),
            DB::raw('SUM(jumlah_diluluskan) as total')
        )
        ->where('status', 'diluluskan')
        ->groupBy('year')
        ->orderBy('year')
        ->get();

        return view('laporan.dana-keluar', compact(
            'approvedClaims',
            'monthlyData',
            'yearlyData'
        ));
    }
}
