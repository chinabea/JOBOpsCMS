<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\IctramJobType;
use App\Models\IctramEquipment;
use App\Models\IctramProblem;

use App\Models\NicmuJobType;
use App\Models\NicmuEquipment;
use App\Models\NicmuProblem;

use App\Models\MisRequestType;
use App\Models\MisAsname;
use App\Models\MisJobType;

class UnitController extends Controller
{
    public function index()
    {
        $countIctramJobTypes = IctramJobType::count();
        $countIctramEquipments = IctramEquipment::count();
        $countIctramProblems = IctramProblem::count();

        $countNicmuJobTypes = NicmuJobType::count();
        $countNicmuEquipments = NicmuEquipment::count();
        $countNicmuProblems = NicmuProblem::count();

        $countMisRequests = MisRequestType::count();
        $countMisAsnames = MisAsname::count();
        $countMisJobTypes = MisJobType::count();
        
        return view('units.index', compact('countIctramJobTypes','countIctramEquipments','countIctramProblems',
                                            'countNicmuJobTypes','countNicmuEquipments','countNicmuProblems',
                                            'countMisRequests','countMisAsnames','countMisJobTypes',
                                        ));
    }

    // public function indexIctramJobType()
    // {
    //     // $jobTypes = IctramJobType::all();
    //     $jobTypes = IctramJobType::withCount('tickets')->get();
    //     return view('units.ictram.JobTypes.index', compact('countJobTypes'));
    // }




    public function purchased()
    {
        // Pass the data to the view
        return view('units.purchased');
    }
    
    public function ictramIndex()
    {
        try {
            // Retrieve all tickets with their associated user (who created the ticket) and the assigned users.
            // Including 'user' in the with clause assumes you have a separate relationship defined in Ticket model to fetch the creator of the ticket
            $tickets = Ticket::orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get();
            
            return view('ticket.ictram-tickets', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function nicmuIndex()
    {
        try {
            // Retrieve all tickets with their associated user (who created the ticket) and the assigned users.
            // Including 'user' in the with clause assumes you have a separate relationship defined in Ticket model to fetch the creator of the ticket
            $tickets = Ticket::orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get();
            
            return view('ticket.nicmu-tickets', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function misIndex()
    {
        try {
            // Retrieve all tickets with their associated user (who created the ticket) and the assigned users.
            // Including 'user' in the with clause assumes you have a separate relationship defined in Ticket model to fetch the creator of the ticket
            $tickets = Ticket::orderBy('created_at', 'desc')->get();
            $userIds = User::where('role', 2)->where('is_approved', true)->get();
            
            return view('ticket.mis-tickets', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}


 