<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TicketUserController extends Controller
{
    public function nonComplianceEscalation(Request $request, $ticketId)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'escalationReasonDue_to_clientNoncompliance' => 'required|string',
            'clientNoncomplianceFile' => 'nullable|file',
        ]);
    
        // Find the ticket
        $ticket = Ticket::findOrFail($ticketId);
    
        // Store the client compliance file if provided
        $clientNoncomplianceFile = null;
        if ($request->hasFile('clientNoncomplianceFile')) {
            $clientNoncomplianceFile = $request->file('clientNoncomplianceFile')->store('client_compliance_files');
        }
    
        // Check if the record exists in the pivot table
        $ticketUser = DB::table('ticket_user')
            ->where('ticket_id', $ticketId)
            ->where('user_id', Auth::id())
            ->first();
    
        if ($ticketUser) {
            // Update the existing record
            DB::table('ticket_user')
                ->where('ticket_id', $ticketId)
                ->where('user_id', Auth::id())
                ->update([
                    'escalationReasonDue_to_clientNoncompliance' => $validatedData['escalationReasonDue_to_clientNoncompliance'],
                    'clientNoncomplianceFile' => $clientNoncomplianceFile,
                    'updated_at' => now()
                ]);
    
            return redirect()->back()->with('success', 'Escalation reasons updated successfully.');
        }
    
        return redirect()->back()->with('error', 'Record not found.');
    }
    
    public function unassign(Request $request, Ticket $ticket)
    {
        // Get the current authenticated user
        $user = Auth::user();

        // Get the reason from the request
        $reason = $request->input('reason');

        // Get the assigned users for the ticket
        $assignedUsers = $ticket->users;

        // If there are assigned users, update the pivot data
        if ($assignedUsers->isNotEmpty()) {
            foreach ($assignedUsers as $assignedUser) {
                // Update the pivot data with additional data (including the reason)
                $ticket->users()->updateExistingPivot($assignedUser->id, [
                    'escalatedBy_for_workloadLimitReached' => $user->id,
                    'escalationReason_for_workloadLimitReached' => $reason,
                    'updated_at' => now()
                ]);
            }
        }

        // Redirect back with a success message
        return redirect()->route('tickets')->with('success', 'You have successfully updated the ticket assignment with a reason for escalation.');
    }
    

    
}
