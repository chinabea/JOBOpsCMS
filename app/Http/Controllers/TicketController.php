<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketCreatedNotification;
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
            Ticket::create($request->all());

            // Redirect to the index or show view, or perform other actions
            return redirect()->route('admin')->with('success', 'Users Successfully Added!');
        } catch (Exception $e) {
            // Handle the exception here, you can log it or return an error response
            return $e->getMessage();
        }
    }

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
}
