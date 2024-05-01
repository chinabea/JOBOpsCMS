<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketAssignedNotification;
use App\Models\User;
use App\Models\Ticket;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function unassigned()
    {
        // Fetch tickets that have no users assigned
        $unassignedTickets = Ticket::doesntHave('users')->get();
        $userIds = User::where('role', 2)->where('is_approved', true)->get(); 

        // Return the view with the unassigned tickets data
        return view('ticket.unassigned', compact('unassignedTickets','userIds'));
    }
    
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
    
        // Attach multiple users to the ticket
        if ($request->filled('assigned_to')) {
            // Using syncWithoutDetaching to avoid duplicate entries and not remove existing ones
            $ticket->users()->syncWithoutDetaching($request->assigned_to);
        }
    
        // Log activity (assuming you have an ActivityLogger set up)
        ActivityLogger::log('Created', $ticket, 'Ticket created');
    
        // Redirect with success message
        return redirect()->route('tickets')->with('success', 'Ticket Successfully Created!');
    }
    

    
    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'file_upload' => 'nullable|file|max:2048',
    //             // 'assigned_to' could be validated here if you decide to expose it in another form
    //         ]);
            
    //         $authUser = auth()->user(); // Renaming variable to avoid confusion
    //         $ticketData = $request->except('file_upload'); // Exclude the file_upload from the request data

    //         // Find all users with role 2
    //         $usersWithRole2 = User::where('role', 2)->get();

    //         // Find the user with role 2 who has the least assigned tickets
    //         $userWithLeastTickets = null;
    //         $minTicketCount = PHP_INT_MAX;
    //         foreach ($usersWithRole2 as $user) {
    //             $ticketCount = $user->tickets()->count();
    //             if ($ticketCount < $minTicketCount) {
    //                 $userWithLeastTickets = $user;
    //                 $minTicketCount = $ticketCount;
    //             }
    //         }

    //         // If there is a user with the least tickets, assign the ticket to this user
    //         if ($userWithLeastTickets) {
    //             $ticketData['assigned_to'] = $userWithLeastTickets->id;
    //         }

    //         // Create the ticket
    //         $ticket = Ticket::create($ticketData);

    //         // Handle file upload
    //         if ($request->hasFile('file_upload')) {
    //             $file = $request->file('file_upload');
    //             $filename = time() . '_' . $file->getClientOriginalName();
    //             $filePath = $file->storeAs('uploads', $filename, 'public');
    //             $ticket->file_path = $filePath;
    //             $ticket->save();
    //         } 

    //         // Log activity
    //         ActivityLogger::log('Created', $ticket, 'Ticket created');

    //         return redirect()->route('tickets')->with('success', 'Ticket Successfully Created!');
    //     } catch (Exception $e) {
    //         // Log the exception or handle it as required
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

    
    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'file_upload' => 'nullable|file|max:2048',
    //             // 'assigned_to' => 'required|exists:users,id', 
    //         ]);
            
    //         $authUser = auth()->user(); // Renaming variable to avoid confusion
    //         // $ticketData = $request->all();
    //         $ticketData = $request->except('file_upload'); 
    
    //         // Create the ticket
    //         $ticket = Ticket::create($ticketData);

    //         // Handle file upload
    //         if ($request->hasFile('file_upload')) {
    //             $file = $request->file('file_upload');
    //             $filename = time() . '_' . $file->getClientOriginalName();
    //             // Save the file to the default storage disk (usually 'public')
    //             $filePath = $file->storeAs('uploads', $filename, 'public');
    //             // Save filePath to your ticket model if needed
    //             $ticket->file_path = $filePath;
    //             $ticket->save();
    //         } 

    //         // Find all users with role 2
    //         $usersWithRole2 = User::where('role', 2)->get();
    
    //         // Find the user with role 2 who has the least assigned tickets
    //         $userWithLeastTickets = null;
    //         $minTicketCount = PHP_INT_MAX;
    //         foreach ($usersWithRole2 as $user) {
    //             $ticketCount = $user->tickets()->count();
    //             if ($ticketCount < $minTicketCount) {
    //                 $userWithLeastTickets = $user;
    //                 $minTicketCount = $ticketCount;
    //             }
    //         }
    
    //         // Assign the ticket to the user with the least assigned tickets
    //         // if ($userWithLeastTickets) {
    //         //     $ticket->assigned_to = $userWithLeastTickets->id;
    //         //     $ticket->save();
            
    //         //     // Notify only the assigned user
    //         //     $userWithLeastTickets->notify(new TicketAssignedNotification($ticket, $userWithLeastTickets));
    
    //         //     // Notify the authenticated user if they are not the assigned user
    //         //     if ($authUser->id !== $userWithLeastTickets->id) {
    //         //         $authUser->notify(new TicketCreatedNotification($authUser, $ticket));
    //         //     }
    
    //         //     // Notify all admin users
    //         //     $admins = User::where('role', 1)->get();
    //         //     foreach ($admins as $admin) {
    //         //         if ($admin->id !== $authUser->id) {
    //         //             $admin->notify(new TicketCreatedNotification($admin, $ticket));
    //         //         }
    //         //     }
    //         // }

    //         // Log activity
    //         ActivityLogger::log('Created', $ticket, 'Ticket created');
    
    //         return redirect()->route('tickets')->with('success', 'Ticket Successfully Created!');
    //     } catch (Exception $e) {
    //         // Log the exception or handle it as required
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

    public function show($id)
    {
        try {
            // Retrieve and show the specific item using the provided ID
            $ticket = Ticket::findOrFail($id);
            
            $user = Ticket::with('users')->findOrFail($id);

            return view('ticket.show', compact('ticket'.'user'));
        } catch (Exception $e) {
            // Handle the exception, you can log it for debugging or display an error message to the user.
            return back()->with('error', 'An error occurred while fetching the ticket: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            
            return view('ticket.edit', compact('ticket'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->update($request->all());

            // Log activity
            ActivityLogger::log('Updated', $ticket, 'Ticket updated');
            
            return redirect()->route('tickets')->with('success', 'Ticket Successfully Updated!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete(); 
            
            // Log activity
            ActivityLogger::log('Deleted', $ticket, 'Ticket Deleted');
            
            return redirect()->back()->with('success', 'Task deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }

    // public function assignTicket(Request $request)
    // {
    //     $task = Task::find($request->input('task_id'));

    //     if (!$task) {
    //         return response()->json(['error' => 'Task not found'], 404);
    //     }

    //     $taskAssignmentService = new TaskAssignmentService();
    //     $user = $taskAssignmentService->assignTaskToUser($task);

    //     return response()->json(['user_id' => $user->id]);
    // }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Open,In Progress,Closed'
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('tickets')->with('success', 'Ticket status updated successfully.');
    }
    
    public function updateUsers(Request $request, $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId); // Ensure the ticket exists
        $userIds = $request->input('assigned_user_id'); // Corrected from user_ids to assigned_user_id
    
        // Sync the users to the ticket
        $ticket->users()->sync($userIds);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Users assigned successfully!');

    }
    



}
