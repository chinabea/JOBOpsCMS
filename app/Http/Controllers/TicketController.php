<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketAssignedNotification;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    
    public function index()
    {
        try {
            $tickets = Ticket::all();
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

            $user = User::find($user);
            Notification::send($user, new TicketCreatedNotification($user, $ticket));

            return view('ticket.create', compact('ticket'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $ticketData = $request->all();
            
            // Create the ticket
            $ticket = Ticket::create($ticketData);

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

                // Notify the user
                $userWithLeastTickets->notify(new TicketAssignedNotification($ticket, $user));
            }

            // Redirect to the index or show view, or perform other actions
            return redirect()->route('admin.home')->with('success', 'Ticket Successfully Created!');
        } catch (Exception $e) {
            // Handle the exception here, you can log it or return an error response
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    // public function store(Request $request)
    // {
    //     try {
    //         Ticket::create($request->all());

    //         // Redirect to the index or show view, or perform other actions
    //         return redirect()->route('admin')->with('success', 'Users Successfully Added!');
    //     } catch (Exception $e) {
    //         // Handle the exception here, you can log it or return an error response
    //         return $e->getMessage();
    //     }
    // }

    // public function show($id)
    // {
    //     try {
    //         $task = Task::findOrFail($id);
    //         return view('tasks.show', compact('task'));
    //     } catch (Exception $e) {
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

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
            
            return redirect()->route('tickets')->with('success', 'Ticket Successfully Updated!');
            // return redirect()->back()->with('success', 'Task Successfully Updated!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete(); 
            
            // return redirect()->route('tickets')->with('success', 'Ticket Successfully Deleted!');
            
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
}
