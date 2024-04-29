<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalTickets = Ticket::count();
        $allOpen = Ticket::where('status', 'Open')->count();
        $allInProgress = Ticket::where('status', 'In Progress')->count();
        $allClosed = Ticket::where('status', 'Closed')->count();
        $allHigh = Ticket::where('priority_level', 'High')->count();
        $allMid = Ticket::where('priority_level', 'Mid')->count();
        $allLow = Ticket::where('priority_level', 'Low')->count();
        
        // Retrieve users where 'created_at' is the same as 'updated_at' and 'is_approved' is false
        $unapprovedUsers = User::whereColumn('created_at', 'updated_at')
                               ->where('is_approved', false)
                               ->get();


        // Monthly data
        $monthlyTicketsData = Ticket::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();
    
        return view('dashboard', compact('monthlyTicketsData', 'totalUsers','totalTickets', 'allOpen',
        'allInProgress', 'allClosed','allHigh', 'allMid', 'allLow', 'unapprovedUsers'));
    }
    
    // public function monthlyWeekly()
    // {
    //     // Monthly data
    //     $monthlyTicketsData = Ticket::select(
    //         DB::raw('MONTH(created_at) as month'),
    //         DB::raw('YEAR(created_at) as year'),
    //         DB::raw('COUNT(*) as count')
    //     )
    //     ->groupBy('year', 'month')
    //     ->orderBy('year', 'asc')
    //     ->orderBy('month', 'asc')
    //     ->get();
    
    //     // Weekly data
    //     $weeklyTicketsData = Ticket::select(
    //         DB::raw('YEAR(created_at) as year'),
    //         DB::raw('WEEK(created_at) as week'),
    //         DB::raw('COUNT(*) as count')
    //     )
    //     ->groupBy('year', 'week')
    //     ->orderBy('year', 'asc')
    //     ->orderBy('week', 'asc')
    //     ->get();
    
    //     return view('dashboard', compact('monthlyTicketsData', 'weeklyTicketsData'));
    // }
    
}
