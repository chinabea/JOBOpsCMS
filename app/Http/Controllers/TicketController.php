<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketAssignedNotification;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Ictram;
use App\Models\Nicmu;
use App\Models\Mis;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use App\Models\ProblemTypeOrEquipment;
use App\Models\Unit;
use Carbon\Carbon;
use App\Models\IctramJobType;


class TicketController extends Controller
{

        public function create()
        {
            // $ictrams = Ictram::with(['jobType', 'equipment', 'problem'])->get();
            // $nicmus = Nicmu::with(['jobType', 'equipment', 'problem'])->get();
            // $mises = Mis::all();
            return view('ticket.create');
        
        }

public function getJobTypeDetails(Request $request)
{
    $jobType = $request->query('unit');
    
    switch ($jobType) {
        case 'ICTRAM':
            $object = Ictram::with(['jobType', 'equipment', 'problem'])->get();
            $details = ['ictram' => $object];
            break;
        case 'NICMUS':
            $object = Nicmu::with(['jobType', 'equipment', 'problem'])->get();
            $details = ['nicmu' => $object];
            break;
        case 'MIS':
            $object = Mis::with(['requestTypeName', 'jobType', 'asName'])->get();
            $details = ['mis' => $object];
            break;
        default:
            $details = [];
            break;
    }

    return response()->json($details);
}

public function getAllDetails(Request $request)
{
    $jobType = $request->query('unit');
    
    switch ($jobType) {
        case 'ICTRAM':
            $object = IctramJobType::with(['jobType', 'equipment', 'problem'])->get();
            $details = ['ictram' => $object];
            break;
        case 'NICMUS':
            $object = Nicmu::with(['jobType', 'equipment', 'problem'])->get();
            $details = ['nicmu' => $object];
            break;
        case 'MIS':
            $object = Mis::with(['requestTypeName', 'jobType', 'asName'])->get();
            $details = ['mis' => $object];
            break;
        default:
            $details = [];
            break;
    }

    return response()->json($details);
}


    public function getJobTypesByUnit($unitId)
    {
        $unit = Unit::find($unitId);
        if (!$unit) {
            return response()->json(['message' => 'Unit not found'], 404);
        }

        $jobTypes = $unit->jobTypes; // Assuming there is a 'jobTypes' relationship defined in Unit model
        return response()->json($jobTypes);
    }
    

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

            // Calculate age for each ticket
            $tickets->each(function ($ticket) {
                $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
            });

            
            return view('ticket.index', compact('tickets','userIds'));
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


        $ticket = new Ticket();
        $ticket->serial_number = $request->serial_number;
        $ticket->covered_under_warranty = $request->has('covered_under_warranty');
        // Set other fields as necessary
        $ticket->save();
        
        // Log activity
        ActivityLogger::log('Created', $ticket, 'Ticket created');
        
        // Redirect with success message
        return redirect()->route('tickets')->with('success', 'Ticket Successfully Created!');
    }


    public function show($id)
    {
        try {
            // Retrieve and show the specific item using the provided ID
            $ticket = Ticket::findOrFail($id);
            
            $user = Ticket::with('users')->findOrFail($id);

            $userIds = User::whereIn('role', [1, 2])
                   ->where('is_approved', true)
                   ->get();

            return view('ticket.show', compact('ticket','user','userIds'));
        } catch (Exception $e) {
            // Handle the exception, you can log it for debugging or display an error message to the user.
            return back()->with('error', 'An error occurred while fetching the ticket: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $priority_level = $ticket->priority_level; 
            $status = $ticket->status; 
            $userIds = User::where('role', 2)->where('is_approved', true)->get();  
            
            return view('ticket.edit', compact('ticket','priority_level','status','userIds'))->with('error', 'An error occurred');
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
