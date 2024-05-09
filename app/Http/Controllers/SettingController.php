<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class SettingController extends Controller
{    
    
    
    public function index()
    {
        try {
            // Retrieve all tickets with their associated user (who created the ticket) and the assigned users.
            // Including 'user' in the with clause assumes you have a separate relationship defined in Ticket model to fetch the creator of the ticket
            $tickets = Ticket::with(['user', 'users'])->orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get();  // Specific user with conditions
            
            return view('ticket.index', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $user = auth()->user();
            $tickets = Ticket::all();
            // $users = User::all(); 
            $userIds = User::where('role', 2)->where('is_approved', true)->get();  // Specific user with conditions

            // Define priorities directly in the controller as an associative array
            $priorities = [
                'High' => 'High',
                'Mid' => 'Mid',
                'Low' => 'Low'
            ];

            return view('ticket.create', compact('tickets', 'priorities', 'userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'file_upload' => 'nullable|file|max:2048',
            'assigned_to' => 'required|array',
            'assigned_to.*' => 'exists:users,id'
        ]);

        // Extract ticket data excluding file upload and assigned_to
        $ticketData = $request->except(['file_upload', 'assigned_to']);
        
        // Create the ticket
        $ticket = Ticket::create($ticketData);
        
        // Handle file upload
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public');
            $ticket->file_path = $filePath;
            $ticket->save();
        }
        
        // Authentication user is the requestor
        $authUser = auth()->user(); 

        $assignedUsers = User::findMany($ticket->assigned_to); // Assuming 'assigned_to' is an array of user IDs
        $assignedNames = $assignedUsers->pluck('name')->join(', ');

        // Notify the requestor and admins
        $admins = User::where('role', 1)->get();
        foreach ($admins as $admin) {
            $isSelf = $admin->id === $authUser->id;
            $admin->notify(new TicketCreatedNotification($admin, $ticket, $authUser, $isSelf, $assignedNames));
        }

        // Attach and notify assigned users
        $ticket->users()->syncWithoutDetaching($request->assigned_to);
        foreach ($request->assigned_to as $userId) {
            $user = User::find($userId);
            $isSelf = $user->id === $authUser->id;
            if ($user && $user->id !== $authUser->id) {
                $user->notify(new TicketAssignedNotification($ticket, $user, $authUser));
            }
        }
        
        // Log activity
        ActivityLogger::log('Created', $ticket, 'Ticket created');
        
        // Redirect with success message
        return redirect()->route('tickets')->with('success', 'Ticket Successfully Created!');
    }

}
