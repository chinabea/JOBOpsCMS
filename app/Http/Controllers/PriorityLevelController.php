<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class PriorityLevelController extends Controller
{
    public function updatePriorityLvl(Request $request, $id)
    {
        // Retrieve the ticket by its ID
        $ticket = Ticket::findOrFail($id);
    
        // Update the ticket's priority_level
        $ticket->priority_level = $request->priority_level;
        $ticket->save();
    
        // Redirect to the tickets route with a success message
        return redirect()->route('tickets')->with('success', 'Ticket Priority level updated successfully.');
    }
    
}
