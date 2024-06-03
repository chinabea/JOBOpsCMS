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
        // Get the start and end dates for the current week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        // Count the open tickets created from Monday to Sunday of the current week
        $totalOpenTicketsPerWeek = Ticket::where('status', 'Open')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        // statistics calculation
        $today = Carbon::today();
        $lastWeek = Carbon::today()->subWeek();
        
        $totalUsers = User::count();
        $totalUsersLastWeek = User::where('created_at', '<', $lastWeek)->count();
        $userPercentageChange = $totalUsersLastWeek > 0 ? (($totalUsers - $totalUsersLastWeek) / $totalUsersLastWeek) * 100 : 0; // Avoid division by zero

        $totalTickets = Ticket::count();
        $totalTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $ticketsPercentageChange = $totalTicketsLastWeek > 0 ? (($totalTickets - $totalTicketsLastWeek) / $totalTicketsLastWeek) * 100 : 0; 

        $totalOpenTickets = Ticket::where('status', 'Open')->count();
        $totalOpenTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalOpenTicketsPercentageChange = $totalOpenTicketsLastWeek > 0 ? (($totalOpenTickets - $totalOpenTicketsLastWeek) / $totalOpenTicketsLastWeek) * 100 : 0; 

        $totalInProgressTickets = Ticket::where('status', 'In Progress')->count();
        $totalInProgressTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalInProgressTicketsPercentageChange = $totalInProgressTicketsLastWeek > 0 ? (($totalInProgressTickets - $totalInProgressTicketsLastWeek) / $totalInProgressTicketsLastWeek) * 100 : 0; 

        $totalClosedTickets = Ticket::where('status', 'Closed')->count();
        $totalClosedTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalClosedTicketsPercentageChange = $totalClosedTicketsLastWeek > 0 ? (($totalClosedTickets - $totalClosedTicketsLastWeek) / $totalClosedTicketsLastWeek) * 100 : 0; 

        $totalHighLevelTickets = Ticket::where('priority_level', 'High')->count();
        $totalHighLevelTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalHighLevelTicketsPercentageChange = $totalHighLevelTicketsLastWeek > 0 ? (($totalHighLevelTickets - $totalHighLevelTicketsLastWeek) / $totalHighLevelTicketsLastWeek) * 100 : 0; 

        $totalMidLevelTickets = Ticket::where('priority_level', 'Mid')->count();
        $totalMidLevelTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalMidLevelTicketsPercentageChange = $totalMidLevelTicketsLastWeek > 0 ? (($totalMidLevelTickets - $totalMidLevelTicketsLastWeek) / $totalMidLevelTicketsLastWeek) * 100 : 0; 

        $totalLowLevelTickets = Ticket::where('priority_level', 'Low')->count();
        $totalLowLevelTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalLowLevelTicketsPercentageChange = $totalLowLevelTicketsLastWeek > 0 ? (($totalLowLevelTickets - $totalLowLevelTicketsLastWeek) / $totalLowLevelTicketsLastWeek) * 100 : 0; 

        $totalUnassignedTickets = Ticket::doesntHave('users')->count();
        $totalUnassignedTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalUnassignedTicketsPercentageChange = $totalUnassignedTicketsLastWeek > 0 ? (($totalUnassignedTickets - $totalUnassignedTicketsLastWeek) / $totalUnassignedTicketsLastWeek) * 100 : 0;  

        $totalPendingApprovalofUsers = User::where('is_approved', false)->count();
        $totalPendingApprovalofUsersLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalPendingApprovalofUsersPercentageChange = $totalPendingApprovalofUsersLastWeek > 0 ? (($totalPendingApprovalofUsers - $totalPendingApprovalofUsersLastWeek) / $totalPendingApprovalofUsersLastWeek) * 100 : 0; 
        
        $userId = auth()->id();
    
        // Fetch tickets where the user is assigned
        $totalAssignedTickets = Ticket::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })
        ->with('user', 'users') // Load relationships
        ->count();
        $totalAssignedTicketsLastWeek = Ticket::where('created_at', '<', $lastWeek)->count();
        $totalAssignedTicketsPercentageChange = $totalAssignedTicketsLastWeek > 0 ? (($totalAssignedTickets - $totalAssignedTicketsLastWeek) / $totalAssignedTicketsLastWeek) * 100 : 0; 
        
        // Retrieve users where 'created_at' is the same as 'updated_at' and 'is_approved' is false
        $unapprovedUsers = User::where('is_approved', false)
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
    
        return view('dashboard', compact('monthlyTicketsData', 'totalUsers','totalTickets', 'totalOpenTickets',
        'totalInProgressTickets', 'totalClosedTickets','totalHighLevelTickets', 'totalMidLevelTickets', 'totalLowLevelTickets', 'unapprovedUsers', 'totalUnassignedTickets', 
        'totalPendingApprovalofUsers', 'totalAssignedTickets', 'totalUsers', 'userPercentageChange', 'totalTickets', 'ticketsPercentageChange', 'totalOpenTicketsPercentageChange', 
        'totalInProgressTicketsPercentageChange', 'totalClosedTicketsPercentageChange', 'totalHighLevelTicketsPercentageChange', 'totalMidLevelTicketsPercentageChange', 
        'totalLowLevelTicketsPercentageChange', 'totalUnassignedTicketsPercentageChange', 'totalPendingApprovalofUsersPercentageChange', 'totalAssignedTicketsPercentageChange',
        'totalOpenTicketsPerWeek',
        ));
    }
}
