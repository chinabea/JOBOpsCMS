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
    public function index()
    {
        try {
            // $tickets = Ticket::all();
            $tickets = Ticket::orderBy('created_at', 'desc')->get();
            return view('ticket.index', compact('tickets'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $user = auth()->user();
            $ticket = Ticket::all();

            // Define priorities directly in the controller as an associative array
            $priorities = [
                'High' => 'High',
                'Mid' => 'Mid',
                'Low' => 'Low'
            ];

            return view('ticket.create', compact('ticket', 'priorities'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'file_upload' => 'nullable|file|max:2048',
                // 'assigned_to' => 'required|exists:users,id', 
            ]);
            
            $authUser = auth()->user(); // Renaming variable to avoid confusion
            // $ticketData = $request->all();
            $ticketData = $request->except('file_upload'); 
    
            // Create the ticket
            $ticket = Ticket::create($ticketData);

            // Handle file upload
            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
                $filename = time() . '_' . $file->getClientOriginalName();
                // Save the file to the default storage disk (usually 'public')
                $filePath = $file->storeAs('uploads', $filename, 'public');
                // Save filePath to your ticket model if needed
                $ticket->file_path = $filePath;
                $ticket->save();
            } 

            // Find all users with role 2
            $usersWithRole2 = User::where('role', 2)->get();
    
            // Find the user with role 2 who has the least assigned tickets
            $userWithLeastTickets = null;
            $minTicketCount = PHP_INT_MAX;
            foreach ($usersWithRole2 as $user) {
                $ticketCount = $user->tickets()->count();
                if ($ticketCount < $minTicketCount) {
                    $userWithLeastTickets = $user;
                    $minTicketCount = $ticketCount;
                }
            }
    
            // Assign the ticket to the user with the least assigned tickets
            if ($userWithLeastTickets) {
                $ticket->assigned_to = $userWithLeastTickets->id;
                $ticket->save();
            
                // Notify only the assigned user
                $userWithLeastTickets->notify(new TicketAssignedNotification($ticket, $userWithLeastTickets));
    
                // Notify the authenticated user if they are not the assigned user
                if ($authUser->id !== $userWithLeastTickets->id) {
                    $authUser->notify(new TicketCreatedNotification($authUser, $ticket));
                }
    
                // Notify all admin users
                $admins = User::where('role', 1)->get();
                foreach ($admins as $admin) {
                    if ($admin->id !== $authUser->id) {
                        $admin->notify(new TicketCreatedNotification($admin, $ticket));
                    }
                }
            }

            // Log activity
            ActivityLogger::log('Created', $ticket, 'Ticket created');
    
            return redirect()->route('tickets')->with('success', 'Ticket Successfully Created!');
        } catch (Exception $e) {
            // Log the exception or handle it as required
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            // Retrieve and show the specific item using the provided ID
            $ticket = Ticket::findOrFail($id);

            return view('ticket.show', compact('ticket'));
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

    public function assignTicket(Request $request)
    {
        $task = Task::find($request->input('task_id'));

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $taskAssignmentService = new TaskAssignmentService();
        $user = $taskAssignmentService->assignTaskToUser($task);

        return response()->json(['user_id' => $user->id]);
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


}
