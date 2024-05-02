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
        

    public function assignedToMe()
    {
        $userId = auth()->id();
    
        // Fetch tickets where the user is assigned
        $assignedTickets = Ticket::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })
        ->with('user', 'users') // Load relationships
        ->orderBy('created_at', 'desc')
        ->get();
    
    
        return view('ticket.assigned', compact('assignedTickets'));
    }
    

    public function unassigned()
    {
        // Fetch tickets that have no users assigned
        $unassignedTickets = Ticket::doesntHave('users')->get();
        // $userIds = User::where('role', 2)->where('is_approved', true)->get(); 
        $userIds = User::whereIn('role', [1, 2])
               ->where('is_approved', true)
               ->get();


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



    // Notify the requestor (if not also an assigned user or an admin)
    // if (!in_array($authUser->id, $request->assigned_to)) {
    //     $authUser->notify(new TicketCreatedNotification($authUser, $ticket, $authUser));
    // }

    // // Attach users to the ticket and notify them
    // $ticket->users()->syncWithoutDetaching($request->assigned_to);
    // foreach ($request->assigned_to as $userId) {
    //     $user = User::find($userId);
    //     if ($user && $user->id !== $authUser->id) {
    //         $user->notify(new TicketAssignedNotification($ticket, $user, $authUser));
    //     }
    // }

    // // Notify all admin users who are not the requestor and not assigned
    // $admins = User::where('role', 1)->get();
    // foreach ($admins as $admin) {
    //     if ($admin->id !== $authUser->id && !in_array($admin->id, $request->assigned_to)) {
    //         $admin->notify(new TicketCreatedNotification($admin, $ticket, $authUser));
    //     }
    // }

    // Log activity
    ActivityLogger::log('Created', $ticket, 'Ticket created');
    
    // Redirect with success message
    return redirect()->route('tickets')->with('success', 'Ticket Successfully Created!');
}

    
    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'file_upload' => 'nullable|file|max:2048',
    //         'assigned_to' => 'required|array',
    //         'assigned_to.*' => 'exists:users,id'
    //     ]);
    
    //     // Extract ticket data excluding file upload and assigned_to
    //     $ticketData = $request->except(['file_upload', 'assigned_to']);
    
    //     // Create the ticket
    //     $ticket = Ticket::create($ticketData);
    
    //     // Handle file upload
    //     if ($request->hasFile('file_upload')) {
    //         $file = $request->file('file_upload');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $filePath = $file->storeAs('uploads', $filename, 'public');
    //         $ticket->file_path = $filePath;
    //         $ticket->save();
    //     }
    //     // add or correct the notification logic based from above code
        
    //     $requestor = auth()->user(); 
    //     // Attach multiple users to the ticket and notify them
    //     if ($request->filled('assigned_to')) {
    //         $ticket->users()->syncWithoutDetaching($request->assigned_to);

    //         // Notify all assigned users
    //         foreach ($request->assigned_to as $userId) {
    //             $user = User::find($userId);
    //             $user->notify(new TicketAssignedNotification($ticket, $user, $requestor));
    //         }
    //     }

    //     $authUser = auth()->user();

    //     // Notify the requestor
    //     $authUser->notify(new TicketCreatedNotification($authUser, $ticket, $requestor));
        
    //     // Notify all admin users
    //     $admins = User::where('role', 1)->get();
    //     foreach ($admins as $admin) {
    //         if ($admin->id !== $authUser->id) {
    //             $admin->notify(new TicketCreatedNotification($admin, $ticket, $requestor));
    //         }
    //     }

    //     if (!empty($request->assigned_to)) {
    //         foreach ($request->assigned_to as $userId) {
    //             $user = User::find($userId);
    //             $user->notify(new TicketAssignedNotification($ticket, $user, $requestor));
    //         }
    //     }
        
        // foreach ($ticket->assignedUsers as $assignedUser) {
        //     $assignedUser->notify(new TicketAssignedNotification($ticket, $assignedUser, $requestor));
        // }

        // Log activity (assuming you have an ActivityLogger set up)
    //     ActivityLogger::log('Created', $ticket, 'Ticket created');
    
    //     // Redirect with success message
    //     return redirect()->route('tickets')->with('success', 'Ticket Successfully Created!');
    // }

    public function show($id)
    {
        try {
            // Retrieve and show the specific item using the provided ID
            $ticket = Ticket::findOrFail($id);
            
            $user = Ticket::with('users')->findOrFail($id);

            return view('ticket.show', compact('ticket','user'));
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
