<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

class StatusController extends Controller
{
    public function assignedOpenTicketStatus()
    {
        $userId = auth()->id();
        
        // Fetch tickets where the user is assigned and where escalationReason_for_workloadLimitReached is null
        $assignedTickets = Ticket::whereHas('assignedUsers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('status', 'Open')
            ->whereDoesntHave('assignedUsers', function ($query) {
                $query->whereNotNull('escalationReason_for_workloadLimitReached');
            })
            ->with(['assignedUsers', 'user']) // Load the 'assignedUsers' and 'user' relationships
            ->orderBy('created_at', 'desc')
            ->get();
    
        $userIds = User::where('is_approved', true)
            ->whereIn('role', [2, 7, 3, 8, 4, 9])
            ->pluck('id');
    
        // Calculate age for each ticket.
        $assignedTickets->each(function ($ticket) {
            $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
        });
        $title = 'Assigned Open Tickets';
    
        return view('assigned-ticket-status.open', compact('assignedTickets', 'userIds', 'title'));
    }

    public function assignedInProgressTicketStatus()
    {
        $userId = auth()->id();
        
        // Fetch tickets where the user is assigned and where escalationReason_for_workloadLimitReached is null
        $assignedTickets = Ticket::whereHas('assignedUsers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('status', 'In Progress')
            ->whereDoesntHave('assignedUsers', function ($query) {
                $query->whereNotNull('escalationReason_for_workloadLimitReached');
            })
            ->with(['assignedUsers', 'user']) // Load the 'assignedUsers' and 'user' relationships
            ->orderBy('created_at', 'desc')
            ->get();
    
        $userIds = User::where('is_approved', true)
            ->whereIn('role', [2, 7, 3, 8, 4, 9])
            ->pluck('id');
    
        // Calculate age for each ticket.
        $assignedTickets->each(function ($ticket) {
            $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
        });
        $title = 'Assigned In Progress Tickets';
    
        return view('assigned-ticket-status.in-progress', compact('assignedTickets', 'userIds', 'title'));
    }

    public function assignedPurchasePartsTicketStatus()
    {
        $userId = auth()->id();
        
        // Fetch tickets where the user is assigned and where escalationReason_for_workloadLimitReached is null
        $assignedTickets = Ticket::whereHas('assignedUsers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('status', 'Purchase Parts')
            ->whereDoesntHave('assignedUsers', function ($query) {
                $query->whereNotNull('escalationReason_for_workloadLimitReached');
            })
            ->with(['assignedUsers', 'user']) // Load the 'assignedUsers' and 'user' relationships
            ->orderBy('created_at', 'desc')
            ->get();
    
        $userIds = User::where('is_approved', true)
            ->whereIn('role', [2, 7, 3, 8, 4, 9])
            ->pluck('id');
    
        // Calculate age for each ticket.
        $assignedTickets->each(function ($ticket) {
            $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
        });
        $title = 'Assigned Purchase Parts Tickets';
    
        return view('assigned-ticket-status.purchase-parts', compact('assignedTickets', 'userIds', 'title'));
    }

    public function assignedClosedTicketStatus()
    {
        $userId = auth()->id();
        
        // Fetch tickets where the user is assigned and where escalationReason_for_workloadLimitReached is null
        $assignedTickets = Ticket::whereHas('assignedUsers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('status', 'Closed')
            ->whereDoesntHave('assignedUsers', function ($query) {
                $query->whereNotNull('escalationReason_for_workloadLimitReached');
            })
            ->with(['assignedUsers', 'user']) // Load the 'assignedUsers' and 'user' relationships
            ->orderBy('created_at', 'desc')
            ->get();
    
        $userIds = User::where('is_approved', true)
            ->whereIn('role', [2, 7, 3, 8, 4, 9])
            ->pluck('id');
    
        // Calculate age for each ticket.
        $assignedTickets->each(function ($ticket) {
            $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
        });
        $title = 'Assigned Closed Tickets';
    
        return view('assigned-ticket-status.closed', compact('assignedTickets', 'userIds', 'title'));
    }

    public function assignedCompletedTicketStatus()
    {
        $userId = auth()->id();
        
        // Fetch tickets where the user is assigned and where escalationReason_for_workloadLimitReached is null
        $assignedTickets = Ticket::whereHas('assignedUsers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('status', 'Completed')
            ->whereDoesntHave('assignedUsers', function ($query) {
                $query->whereNotNull('escalationReason_for_workloadLimitReached');
            })
            ->with(['assignedUsers', 'user']) // Load the 'assignedUsers' and 'user' relationships
            ->orderBy('created_at', 'desc')
            ->get();
    
        $userIds = User::where('is_approved', true)
            ->whereIn('role', [2, 7, 3, 8, 4, 9])
            ->pluck('id');
    
        // Calculate age for each ticket.
        $assignedTickets->each(function ($ticket) {
            $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
        });
        $title = 'Assigned Completed Tickets';
    
        return view('assigned-ticket-status.completed', compact('assignedTickets', 'userIds', 'title'));
    }
    
    


































    public function purchaseParts()
    {
        try {
            $tickets = Ticket::where('status', 'Purchase Parts')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('is_approved', true)->get(); 

            return view('status.purchase-parts', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function completed()
    {
        try {
            $tickets = Ticket::where('status', 'Completed')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

            return view('status.completed', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function open()
    {
        try {
            $tickets = Ticket::where('status', 'Open')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

            return view('status.open', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function inProgress()
    {
        try {
            $tickets = Ticket::where('status', 'In Progress')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

            return view('status.in-progress', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function closed()
    {
        try {
            $tickets = Ticket::where('status', 'Closed')->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

            return view('status.closed', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
