<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketAssignedNotification;
use App\Models\ProblemTypeOrEquipment;
use App\Models\Ictram;
use App\Models\Nicmu;
use App\Models\Mis;
use App\Services\ActivityLogger;
use App\Models\User;
use App\Models\Unit;
use Carbon\Carbon;
use App\Models\IctramJobType;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Dompdf\Dompdf;
use Dompdf\Options;
use Storage;


class TicketController extends Controller
{
    public function index()
    {
        try {
            // Retrieve all tickets with their associated users.
            $tickets = Ticket::with('users')->orderBy('created_at', 'desc')->get();
            
            // Retrieve necessary related data.
            $ictram = Ictram::all();
            $nicmu = Nicmu::all();
            $mis = Mis::all();
            
            // Retrieve approved users.
            // $userIds = User::where('is_approved', true)->get();
            $userIds = User::where('is_approved', true)
            ->whereIn('role', [2, 7, 3, 8, 4, 9])
            ->get();

            // Calculate age for each ticket.
            $tickets->each(function ($ticket) {
                $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
            });

            return view('ticket.index', compact('tickets', 'userIds', 'ictram', 'nicmu', 'mis'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }   

    public function assignedToMe()
    {
        $userId = auth()->id();
        
        // Fetch tickets where the user is assigned and where escalationReason_for_workloadLimitReached is null
        $assignedTickets = Ticket::whereHas('assignedUsers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->whereDoesntHave('assignedUsers', function ($query) {
                $query->whereNotNull('escalationReason_for_workloadLimitReached');
            })
            ->with(['assignedUsers', 'user']) // Load the 'assignedUsers' and 'user' relationships
            ->orderBy('created_at', 'desc')
            ->get();

        $userIds = User::where('is_approved', true)
            ->whereIn('role', [2, 7, 3, 8, 4, 9])
            ->get();

            // Calculate age for each ticket.
            $assignedTickets->each(function ($ticket) {
                $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
            });

        return view('ticket.assigned', compact('assignedTickets', 'userIds'));
    }


    // public function assignedToMe()
    // {
    //     $userId = auth()->id();
        
    //     // Fetch tickets where the user is assigned
    //     $assignedTickets = Ticket::whereHas('assignedUsers', function ($query) use ($userId) {
    //         $query->where('user_id', $userId);
    //     })
    //     ->with(['assignedUsers', 'user']) // Load the 'assignedUsers' and 'user' relationships
    //     ->orderBy('created_at', 'desc')
    //     ->get();

    //     $userIds = User::where('is_approved', true)
    //     ->whereIn('role', [2, 7, 3, 8, 4, 9])
    //     ->get();
    
    //     return view('ticket.assigned', compact('assignedTickets', 'userIds'));
    // }
    


    // public function index()
    // {
    //     try {
    //         // $tickets = Ticket::whereBetween('created_at', [$start_date, $end_date])->get();
    //         $ictram = Ictram::all();
    //         $nicmu = Nicmu::all();
    //         $mis = Mis::all();
    //         // Retrieve all tickets with their associated user (who created the ticket) and the assigned users.
    //         // Including 'user' in the with clause assumes you have a separate relationship defined in Ticket model to fetch the creator of the ticket
    //         $tickets = Ticket::orderBy('created_at', 'desc')->get();
    //         $userIds = User::where('is_approved', true)->get();  // Specific user with conditions

    //         // Calculate age for each ticket
    //         $tickets->each(function ($ticket) {
    //             $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
    //         });

            
    //         return view('ticket.index', compact('tickets', 'userIds', 'ictram', 'nicmu', 'mis'));
    //     } catch (Exception $e) {
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }
    

    // ---------------------------------------------------------------------------------------------------------------------
    public function store(Request $request)
    {
        // Handle file upload
        $filePath = $request->hasFile('file_path') ? $request->file('file_path')->store('uploads') : null;
    
        // Create a new ticket instance
        $ticket = new Ticket([
            'building_number' => $request->input('building_number'),
            'office_name' => $request->input('office_name'),
            'description' => $request->input('description'),
            'file_path' => $filePath,
            'serial_number' => $request->input('serial_number'),
            'covered_under_warranty' => $request->input('covered_under_warranty') ? 1 : 0,
            'user_id' => auth()->id(), 
            'ictram_id' => $request->input('ictram_id'),
            'nicmu_id' => $request->input('nicmu_id'),
            'mis_id' => $request->input('mis_id'),
        ]);
    
        // Determine the appropriate user roles based on request unit
        $roles = [2, 3, 4, 7, 8, 9];
    
        if ($request->input('ictram_id')) {
            $roles = [2, 7];
        } elseif ($request->input('nicmu_id')) {
            $roles = [3, 8];
        } elseif ($request->input('mis_id')) {
            $roles = [4, 9];
        }
    
        // Find users with the specified roles
        $users = User::whereIn('role', $roles)->get();
    
        // Find the user with the least number of assigned tickets
        $userWithLeastTickets = $users->sortBy(function ($user) {
            return $user->tickets->count();
        })->first();
    
        // Save the ticket first to get its ID
        $ticket->save();
    
        // Attach the ticket to the user with the least tickets
        if ($userWithLeastTickets) {
            $ticket->users()->attach($userWithLeastTickets->id);
        }
    
        // Authentication user is the requestor
        $authUser = auth()->user(); 
    
        // Notify the requestor and admins
        $admins = User::where('role', 1)->get();
        foreach ($admins as $admin) {
            $isSelf = $admin->id === $authUser->id;
            $admin->notify(new TicketCreatedNotification($admin, $ticket, $authUser, $isSelf));
        }
    
        // Notify assigned users if there are any
        if ($request->has('assigned_to')) {
            $ticket->users()->syncWithoutDetaching($request->assigned_to);
            foreach ($request->assigned_to as $userId) {
                $user = User::find($userId);
                if ($user && $user->id !== $authUser->id) {
                    $user->notify(new TicketAssignedNotification($ticket, $user, $authUser));
                }
            }
        }
    
        // Log activity
        ActivityLogger::log('Created', $ticket, 'Ticket created');
    
        // Redirect back or to a success page
        return redirect()->route('tickets')->with('success', 'Ticket created successfully and assigned to the user with the least tickets.');
    }
    
    // public function store(Request $request)
    // {
    //     // Handle file upload
    //     $filePath = $request->hasFile('file_path') ? $request->file('file_path')->store('uploads') : null;
    
    //     // Create a new ticket instance
    //     $ticket = new Ticket([
    //         'building_number' => $request->input('building_number'),
    //         'office_name' => $request->input('office_name'),
    //         'description' => $request->input('description'),
    //         'file_path' => $filePath,
    //         'serial_number' => $request->input('serial_number'),
    //         'covered_under_warranty' => $request->input('covered_under_warranty') ? 1 : 0,
    //         'user_id' => auth()->id(), 
    //         'ictram_id' => $request->input('ictram_id'),
    //         'nicmu_id' => $request->input('nicmu_id'),
    //         'mis_id' => $request->input('mis_id'),
    //     ]);
    
    //     // Determine the appropriate user roles based on request unit
    //     $roles = [2, 3, 4, 7, 8, 9];
    
    //     if ($request->input('ictram_id')) {
    //         $roles = [2, 7];
    //     } elseif ($request->input('nicmu_id')) {
    //         $roles = [3, 8];
    //     } elseif ($request->input('mis_id')) {
    //         $roles = [4, 9];
    //     }
    
    //     // Find users with the specified roles
    //     $users = User::whereIn('role', $roles)->get();
    
    //     // Find the user with the least number of assigned tickets
    //     $userWithLeastTickets = $users->sortBy(function ($user) {
    //         return $user->tickets->count();
    //     })->first();
    
    //     // Assign the ticket to that user
    //     if ($userWithLeastTickets) {
    //         $ticket->assigned_user_id = $userWithLeastTickets->id;
    //     }
    
    //     $ticket->save();
    
    //     // Authentication user is the requestor
    //     $authUser = auth()->user(); 
    
    //     // Notify the requestor and admins
    //     $admins = User::where('role', 1)->get();
    //     foreach ($admins as $admin) {
    //         $isSelf = $admin->id === $authUser->id;
    //         $admin->notify(new TicketCreatedNotification($admin, $ticket, $authUser, $isSelf));
    //     }
    
    //     // Notify assigned users if there are any
    //     if ($request->has('assigned_to')) {
    //         $ticket->users()->syncWithoutDetaching($request->assigned_to);
    //         foreach ($request->assigned_to as $userId) {
    //             $user = User::find($userId);
    //             if ($user && $user->id !== $authUser->id) {
    //                 $user->notify(new TicketAssignedNotification($ticket, $user, $authUser));
    //             }
    //         }
    //     }
    
    //     // Log activity
    //     ActivityLogger::log('Created', $ticket, 'Ticket created');
    
    //     // Redirect back or to a success page
    //     return redirect()->route('tickets')->with('success', 'Ticket created successfully and assigned to the user with the least tickets.');
    // }

    // public function store(Request $request)
    // {
    //         // Handle file upload
    //         if ($request->hasFile('file_path')) {
    //             $filePath = $request->file('file_path')->store('uploads');
    //         } else {
    //             $filePath = null;
    //         }
    //           $ticket = new Ticket([
    //         'building_number' => $request->input('building_number'),
    //         'office_name' => $request->input('office_name'),
    //         'description' => $request->input('description'),
    //         'file_path' => $filePath,
    //         'serial_number' => $request->input('serial_number'),
    //         'covered_under_warranty' => $request->input('covered_under_warranty') ? 1 : 0,
    //         'user_id' => auth()->id(), 
    //         'ictram_id' => $request->input('ictram_id'),
    //         'nicmu_id' => $request->input('nicmu_id'),
    //         'mis_id' => $request->input('mis_id'),
    //     ]);


    //     // Determine the appropriate user roles based on request unit
    //     $roles = [2, 3, 4, 7, 8, 9];

    //     if ($request->input('ictram_id')) {
    //         $roles = [2, 7];
    //     } elseif ($request->input('nicmu_id')) {
    //         $roles = [3, 8];
    //     } elseif ($request->input('mis_id')) {
    //         $roles = [4, 9];
    //     }

    //     // Find users with the specified roles
    //     $users = User::whereIn('role', $roles)->get();

    //     // Find the user with the least number of assigned tickets
    //     $userWithLeastTickets = $users->sortBy(function ($user) {
    //         return $user->tickets->count();
    //     })->first();

    //     // Assign the ticket to that user
    //     $ticket->assigned_user_id = $userWithLeastTickets->id;
    //     $ticket->save();
    //         // Authentication user is the requestor
    //     $authUser = auth()->user(); 

    //     $assignedUsers = User::findMany($ticket->assigned_to); // Assuming 'assigned_to' is an array of user IDs
    //     $assignedNames = $assignedUsers->pluck('name')->join(', ');

    //     // Notify the requestor and admins
    //     $admins = User::where('role', 1)->get();
    //     foreach ($admins as $admin) {
    //         $isSelf = $admin->id === $authUser->id;
    //         $admin->notify(new TicketCreatedNotification($admin, $ticket, $authUser, $isSelf, $assignedNames));
    //     }

    //     // Attach and notify assigned users
    //     $ticket->users()->syncWithoutDetaching($request->assigned_to);
    //     foreach ($request->assigned_to as $userId) {
    //         $user = User::find($userId);
    //         $isSelf = $user->id === $authUser->id;
    //         if ($user && $user->id !== $authUser->id) {
    //             $user->notify(new TicketAssignedNotification($ticket, $user, $authUser));
    //         }
    //     }

        
    //     // Log activity
    //     ActivityLogger::log('Created', $ticket, 'Ticket created');

    //     // Redirect back or to a success page
    //     return redirect()->back()->with('success', 'Ticket created successfully and assigned to the user with the least tickets.');
    // }



    
    
    public function create()
    {
        
        // $ictrams = Ictram::with(['jobType', 'equipment', 'problem'])->get();
        // $nicmus = Nicmu::with(['jobType', 'equipment', 'problem'])->get();
        // $mis = Mis::with(['requestType', 'jobType', 'asname'])->get();

        // $ictrams = Ictram::all();
        // $nicmus = Nicmu::all();
        // $mis = Mis::all();

        return view('ticket.create');
    }

    public function getJobTypes(Request $request)
    {
        $type = $request->input('type');
        $jobTypes = [];

        switch ($type) {
            case 'ictram':
                $jobTypes = IctramJobType::all();
                break;
            case 'nicmu':
                // Replace with appropriate model
                $jobTypes = NicmuJobType::all();
                break;
            case 'mis':
                // Replace with appropriate model
                $jobTypes = MisJobType::all();
                break;
        }

        return response()->json($jobTypes);
    }

    public function getEquipments(Request $request)
    {
        $type = $request->input('type');
        $jobTypeId = $request->input('job_type_id');
        $equipments = [];

        switch ($type) {
            case 'ictram':
                $equipments = IctramEquipment::where('job_type_id', $jobTypeId)->get();
                break;
            case 'nicmu':
                // Replace with appropriate model and condition
                $equipments = NicmuEquipment::where('job_type_id', $jobTypeId)->get();
                break;
            case 'mis':
                // Replace with appropriate model and condition
                $equipments = MisEquipment::where('job_type_id', $jobTypeId)->get();
                break;
        }

        return response()->json($equipments);
    }

    public function getProblems(Request $request)
    {
        $type = $request->input('type');
        $equipmentId = $request->input('equipment_id');
        $problems = [];

        switch ($type) {
            case 'ictram':
                $problems = IctramProblem::where('equipment_id', $equipmentId)->get();
                break;
            case 'nicmu':
                // Replace with appropriate model and condition
                $problems = NicmuProblem::where('equipment_id', $equipmentId)->get();
                break;
            case 'mis':
                // Replace with appropriate model and condition
                $problems = MisProblem::where('equipment_id', $equipmentId)->get();
                break;
        }

        return response()->json($problems);
    }



    // ----------------------------------------------------------------------------------------------------------------------


    public function getOptions(Request $request)
    {
        $type = $request->input('type');
        $options = [];
    
        switch ($type) {
            case 'ictram':
                $options = IctramJobType::with('equipments.problems')->get();
                break;
            case 'nicmu':
                $options = NicmuJobType::with('equipments.problems')->get();
                break;
            case 'mis':
                $options = MisRequestType::with('jobTypes.asnames')->get();
                break;
        }
    
        return response()->json($options);
    }
    
    // public function getOptions(Request $request)
    // {
    //     $type = $request->input('type');
    //     $options = [];

    //     switch ($type) {
    //         case 'ictram':
    //             $options = Ictram::with(['jobType', 'equipment', 'problem'])->get();
    //             break;
    //         case 'nicmu':
    //             $options = Nicmu::with(['jobType', 'equipment', 'problem'])->get();
    //             break;
    //         case 'mis':
    //             $options = Mis::with(['requestType', 'jobType', 'asname'])->get();
    //             break;
    //     }

    //     return response()->json($options);
    // }

// public function getJobTypeDetails(Request $request)
// {
//     $jobType = $request->query('unit');
    
//     switch ($jobType) {
//         case 'ICTRAM':
//             $object = Ictram::with(['jobType', 'equipment', 'problem'])->get();
//             $details = ['ictram' => $object];
//             break;
//         case 'NICMUS':
//             $object = Nicmu::with(['jobType', 'equipment', 'problem'])->get();
//             $details = ['nicmu' => $object];
//             break;
//         case 'MIS':
//             $object = Mis::with(['requestTypeName', 'jobType', 'asName'])->get();
//             $details = ['mis' => $object];
//             break;
//         default:
//             $details = [];
//             break;
//         if ($request->has('priority_level')) {
//             $query->where('priority_level', $request->priority_level);
//         }

//         if ($request->has('status')) {
//             $query->where('status', $request->status);
//         }

//         $sortBy = $request->input('sort_by', 'id');
//         $sortDirection = $request->input('sort_order', 'asc');

//         $tickets = $query->orderBy($sortBy, $sortDirection)->get();

//         return view('ticket.index', compact('tickets','userIds'));
//     }
// }


// public function getAllDetails(Request $request)
// {
//     $jobType = $request->query('unit');
    
//     switch ($jobType) {
//         case 'ICTRAM':
//             $object = IctramJobType::with(['jobType', 'equipment', 'problem'])->get();
//             $details = ['ictram' => $object];
//             break;
//         case 'NICMUS':
//             $object = Nicmu::with(['jobType', 'equipment', 'problem'])->get();
//             $details = ['nicmu' => $object];
//             break;
//         case 'MIS':
//             $object = Mis::with(['requestTypeName', 'jobType', 'asName'])->get();
//             $details = ['mis' => $object];
//             break;
//         default:
//             $details = [];
//             break;
//     }

//     return response()->json($details);
// }


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
    

    
    
    
    
    // public function assignedToMe()
    // {
    //     $tickets = Ticket::with('users')->orderBy('created_at', 'desc')->get();
    //     $userId = auth()->id();
    
    //     // Fetch tickets where the user is assigned
    //     $assignedTickets = Ticket::whereHas('users', function ($query) use ($userId) {
    //         $query->where('users.id', $userId);
    //     })
    //     ->with('user', 'users') // Load relationships
    //     ->orderBy('created_at', 'desc')
    //     ->get();
    
    
    //     return view('ticket.assigned', compact('assignedTickets', 'tickets'));
    // }
    

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
    
    public function show($id)
    {
        try {
            // Retrieve the specific ticket using the provided ID
            // $ticket = Ticket::findOrFail($id);
            $ticket = Ticket::with('assignedUsers')->findOrFail($id);
    
            // Retrieve approved users with specific roles
            // $userIds = User::whereIn('role', [1, 2])
            //        ->where('is_approved', true)
            //        ->get();
    
            // Pass the ticket and userIds to the view
            return view('ticket.show', compact('ticket'));
        } catch (Exception $e) {
            // Handle the exception, log it, or display an error message to the user
            return back()->with('error', 'An error occurred while fetching the ticket: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $userIds = User::where('role', 2)->where('is_approved', true)->get();  
            
            return view('ticket.edit', compact('ticket', 'userIds'))->with('error', 'An error occurred');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->update($request->except(['initial_assessment', 'action_performed']));
            $ticket->initial_assessment = $request->initial_assessment;
            $ticket->action_performed = $request->action_performed;
            $ticket->save();
            
            // Log activity
            ActivityLogger::log('Updated', $ticket, 'Ticket updated');
            
            return redirect()->route('tickets')->with('success', 'Ticket Successfully Updated!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // public function edit($id)
    // {
    //     try {
    //         $ticket = Ticket::findOrFail($id);
    //         $priority_level = $ticket->priority_level; 
    //         $status = $ticket->status; 
    //         $userIds = User::where('role', 2)->where('is_approved', true)->get();  
            
    //         return view('ticket.edit', compact('ticket','priority_level','status','userIds'))->with('error', 'An error occurred');
    //     } catch (Exception $e) {
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $ticket = Ticket::findOrFail($id);
    //         $ticket->update($request->all());
    //         $ticket->initial_assessment = $request->initial_assessment;
    //         $ticket->action_performed = $request->action_performed;
    //         $ticket->save();
            
            

    //         // Log activity
    //         ActivityLogger::log('Updated', $ticket, 'Ticket updated');
            
    //         return redirect()->route('tickets')->with('success', 'Ticket Successfully Updated!');

    //     } catch (Exception $e) {
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

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
        // Retrieve the ticket by its ID
        $ticket = Ticket::findOrFail($id);
    
        // Check if status is being updated to 'In Progress' and was not 'In Progress' before
        if ($request->status == 'In Progress' && $ticket->status != 'In Progress') {
            $reason = $request->input('reason');
            $ticket->reason = $reason;
            // Example: Log the reason
            Log::info("Ticket {$id} marked as 'In Progress'. Reason: {$reason}");
        } else {
            $ticket->reason = null; // Clear the reason if not in progress
        }
    
        // Check if status is being updated to 'Purchase Parts' and was not 'Purchase Parts' before
        if ($request->status == 'Purchase Parts' && $ticket->status != 'Purchase Parts') {
            $purchase_part = $request->input('purchase_part');
            $ticket->purchase_part = $purchase_part;
            // Example: Log the purchase_part
            Log::info("Ticket {$id} marked as 'Purchase Parts'. purchase_part: {$purchase_part}");
        } else {
            $ticket->purchase_part = null; // Clear the purchase_part if not Purchase Parts
        }
    
        // Update the ticket's status
        $ticket->status = $request->status;
        $ticket->save();
    
        // Redirect to the tickets route with a success message
        return redirect()->route('tickets')->with('success', 'Ticket status updated successfully.');
    }
    
    // public function updateUsers(Request $request, $ticketId)
    // {
    //     $ticket = Ticket::findOrFail($ticketId); // Ensure the ticket exists
    //     $userId = $request->input('assigned_user_id'); // Get the assigned user ID

    //     // Assign the user to the ticket
    //     $ticket->assigned_user_id = $userId;
    //     $ticket->save();

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'User assigned successfully!');
    // }

    
    // public function updateUsers(Request $request, $ticketId)
    // {
    //     $ticket = Ticket::findOrFail($ticketId); // Ensure the ticket exists
    //     $userIds = $request->input('assigned_user_id'); // Corrected from user_ids to assigned_user_id
    
    //     // Sync the users to the ticket
    //     $ticket->users()->sync($userIds);
    
    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Users assigned successfully!');

    // }    
    // public function updateUsers(Request $request, $ticketId)
    // {
    //     $ticket = Ticket::findOrFail($ticketId); // Ensure the ticket exists
    //     $userIds = $request->input('assigned_user_id'); // Corrected from user_ids to assigned_user_id
    
    //     // Sync the users to the ticket
    //     $ticket->users()->sync($userIds);
        
    //     // Create an empty collection for userIds initially
    //     $userIds = collect();
    
    //     // Loop through tickets and fetch users based on ticket type
    //     if ($ticket->ictram) {
    //         $userIds = User::whereIn('role', [2, 7])->where('is_approved', true)->get();
    //     } elseif ($ticket->nicmu) {
    //         $userIds = User::whereIn('role', [3, 8])->where('is_approved', true)->get();
    //     } elseif ($ticket->mis) {
    //         $userIds = User::whereIn('role', [9, 4])->where('is_approved', true)->get();
    //     }
    
    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Users assigned successfully!');
    // }
    
    // public function updateUsers(Request $request, $ticketId)
    // {
    //     $ticket = Ticket::findOrFail($ticketId); // Ensure the ticket exists
    //     // $userIds = $request->input('assigned_user_id'); // Corrected from user_ids to assigned_user_id
    //     $userIds = User::where('is_approved', true)->get();  
    
    //     // Sync the users to the ticket
    //     $ticket->users()->sync($userIds);
    
    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Users assigned successfully!');

    // }

    public function updateUsers(Request $request, $ticketId)
    {
        // Ensure the ticket exists
        $ticket = Ticket::findOrFail($ticketId);

        // Get the user IDs from the request input
        $userIds = $request->input('assigned_user_id'); // This should match the name attribute in your form

        // Ensure user IDs are only those approved and not any random input
        $approvedUserIds = User::where('is_approved', true)
                            ->whereIn('id', $userIds)
                            ->pluck('id');

        // Sync the approved users to the ticket
        $ticket->users()->sync($approvedUserIds);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Users assigned successfully!');
    }
    

    // public function unassign(Request $request, Ticket $ticket)
    // {
    //     // Get the current authenticated user
    //     $user = Auth::user();

    //     // Store the current assigned user ID in the escalatedBy_for_workloadLimitReached field
    //     $ticket->escalatedBy_for_workloadLimitReached = $ticket->assigned_user_id;

    //     // Unassign the ticket and set the escalation reason
    //     $ticket->assigned_user_id = null;
    //     $ticket->escalationReason_for_workloadLimitReached = $request->input('reason');
    //     $ticket->save();
        
    //     // Redirect back with a success message
    //     return redirect()->route('tickets')->with('success', 'You have successfully unassigned the ticket with a reason for escalation.');
    // }
    


    public function assignUserToTicket(Request $request, $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $userId = $request->input('user_id');

        // Additional pivot data
        $pivotData = [
            'escalationReason_for_workloadLimitReached' => $request->input('escalationReason_for_workloadLimitReached'),
            'escalatedBy_for_workloadLimitReached' => $request->input('escalatedBy_for_workloadLimitReached'),
            'escalationReasonDue_to_clientNoncompliance' => $request->input('escalationReasonDue_to_clientNoncompliance'),
            'clientNoncomplianceFile' => $request->input('clientNoncomplianceFile'),
        ];

        $ticket->assignedUsers()->attach($userId, $pivotData);

        return redirect()->route('tickets.show', $ticketId);
    }


    

}
