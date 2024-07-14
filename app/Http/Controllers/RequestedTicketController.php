<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\ProblemTypeOrEquipment;
use App\Models\Ictram;
use App\Models\Nicmu;
use App\Models\Mis;
use App\Services\ActivityLogger;
use App\Models\User;
use App\Models\Unit;
use Carbon\Carbon;
use App\Models\IctramJobType;
use App\Models\BuildingNumber;
use App\Models\OfficeName;

class RequestedTicketController extends Controller
{
    public function myRequestedTickets(){
        // Retrieve all tickets with their associated users.
        // $tickets = Ticket::with('users')->orderBy('created_at', 'desc')->get();
        
        $user = auth()->user();
        $tickets = Ticket::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        // Retrieve necessary related data.
        $ictram = Ictram::all();
        $nicmu = Nicmu::all();
        $mis = Mis::all();
        $buildingNumbers = BuildingNumber::all();
        $officeNames = OfficeName::all(); 
        
        // Retrieve approved users.
        // $userIds = User::where('is_approved', true)->get();
        $userIds = User::where('is_approved', true)
        ->whereIn('role', [2, 7, 3, 8, 4, 9])
        ->get();

        return view('ticket.my-requested-tickets', compact('tickets', 'userIds', 'ictram', 'nicmu', 'mis', 'buildingNumbers', 'officeNames'));
    }
}
