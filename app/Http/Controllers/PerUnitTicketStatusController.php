<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictram;
use App\Models\Nicmu;
use App\Models\Mis;
use App\Models\User;
use App\Models\Ticket;

class PerUnitTicketStatusController extends Controller
{
    public function ictramOpenTicketStatus(){
        
        $ictrams = Ictram::all();
        $tickets = Ticket::where('status', 'Open')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'ICTRAM Open Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function ictramInProgressTicketStatus(){
        
        $ictrams = Ictram::all();
        $tickets = Ticket::where('status', 'In Progress')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'ICTRAM In Progress Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function ictramPurchasingPartsTicketStatus(){
        
        $ictrams = Ictram::all();
        $tickets = Ticket::where('status', 'Purchase Parts')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'ICTRAM Purchasing Parts Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function ictramClosedTicketStatus(){
        
        $ictrams = Ictram::all();
        $tickets = Ticket::where('status', 'Closed')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'ICTRAM Closed Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function ictramCompletedTicketStatus(){
        
        $ictrams = Ictram::all();
        $tickets = Ticket::where('status', 'Completed')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'ICTRAM Completed Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }




    
    public function nicmuOpenTicketStatus(){
        
        $ictrams = Nicmu::all();
        $tickets = Ticket::where('status', 'Open')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'NICMU Open Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function nicmuInProgressTicketStatus(){
        
        $ictrams = Nicmu::all();
        $tickets = Ticket::where('status', 'In Progress')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'NICMU In Progress Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function nicmuClosedTicketStatus(){
        
        $ictrams = Nicmu::all();
        $tickets = Ticket::where('status', 'Closed')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'NICMU Closed Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function nicmuCompletedTicketStatus(){
        
        $ictrams = Nicmu::all();
        $tickets = Ticket::where('status', 'Completed')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'NICMU Completed Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }




    
    public function misOpenTicketStatus(){
        
        $ictrams = Mis::all();
        $tickets = Ticket::where('status', 'Open')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'MIS Open Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function misInProgressTicketStatus(){
        
        $ictrams = Mis::all();
        $tickets = Ticket::where('status', 'In Progress')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'MIS In Progress Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function misClosedTicketStatus(){
        
        $ictrams = Mis::all();
        $tickets = Ticket::where('status', 'Closed')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'MIS Closed Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }

    public function misCompletedTicketStatus(){
        
        $ictrams = Mis::all();
        $tickets = Ticket::where('status', 'Completed')->orderBy('created_at', 'desc')->get();
        $userIds = User::where('is_approved', true)->get(); 
        $title = 'MIS Completed Tickets';

        return view('units-access.units-status', compact('ictrams', 'userIds', 'tickets', 'title'));
    }
}
