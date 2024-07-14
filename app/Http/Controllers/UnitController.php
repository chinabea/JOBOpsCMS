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
use Illuminate\Support\Facades\DB;

use App\Models\Ictram;
use App\Models\Nicmu;
use App\Models\Mis;
use App\Models\BuildingNumber;
use App\Models\OfficeName;
use Carbon\Carbon;


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
        // Retrieve tickets with the status 'Purchase Parts'
        $purchasedParts = Ticket::where('status', 'Purchase Parts')
            ->select('purchase_parts', DB::raw('COUNT(*) as number_of_parts'))
            ->groupBy('purchase_parts')
            ->get();

        // Process the purchased parts
        $separatedParts = [];
        foreach ($purchasedParts as $part) {
            $parts = explode(',', $part->purchase_parts);
            foreach ($parts as $item) {
                $item = trim($item); // Trim any whitespace
                if (!isset($separatedParts[$item])) {
                    $separatedParts[$item] = 0;
                }
                $separatedParts[$item] += $part->number_of_parts;
            }
        }

        // Convert associative array to a collection of objects for easier handling in the view
        $separatedParts = collect($separatedParts)->map(function ($count, $item) {
            return (object) ['item' => $item, 'count' => $count];
        });

        // Sort the collection by count in descending order
        $separatedParts = $separatedParts->sortByDesc('count');

        // Pass the data to the view
        return view('units.purchased', compact('separatedParts'));
    }
    
    // public function purchased()
    // {
    //     // Retrieve tickets with the status 'Purchase Parts'
    //     $purchasedParts = Ticket::where('status', 'Purchase Parts')
    //         ->select('purchase_parts', DB::raw('COUNT(*) as number_of_parts'))
    //         ->groupBy('purchase_parts')
    //         ->get();

    //     // Pass the data to the view
    //     return view('units.purchased', compact('purchasedParts'));
    // }
    
    public function ictramIndex()
    {
        try {
            // Retrieve all tickets with their associated user (who created the ticket) and the assigned users.
            // Including 'user' in the with clause assumes you have a separate relationship defined in Ticket model to fetch the creator of the ticket
            $tickets = Ticket::orderBy('created_at', 'desc')->get();
            
            // Retrieve necessary related data.
            $ictram = Ictram::all();
            $nicmu = Nicmu::all();
            $mis = Mis::all();
            $buildingNumbers = BuildingNumber::all();
            $officeNames = OfficeName::all(); 
            $userIds = User::where('is_approved', true)
            ->whereIn('role', [2, 7, 3, 8, 4, 9])
            ->get();

            // Calculate age for each ticket.
            $tickets->each(function ($ticket) {
                $ticket->age = Carbon::parse($ticket->created_at)->diffInDays(Carbon::now());
            });
            
            // return view('ticket.unit-tickets.ictram-tickets', compact('tickets'));
                return view('ticket.unit-tickets.ictram-tickets', compact('tickets', 'userIds', 'ictram', 'buildingNumbers', 'officeNames'));
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
            
            return view('ticket.unit-tickets.nicmu-tickets', compact('tickets','userIds'));
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
            
            return view('ticket.unit-tickets.mis-tickets', compact('tickets','userIds'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}


 