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
    
}
