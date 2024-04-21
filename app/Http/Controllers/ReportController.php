<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\User;
use App\Models\FAQs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\PDF;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    // public function index()
    // {
    //     $tickets = Ticket::all();  // You already have this based on your debug info.
    //     $user = auth()->user();    // Ensuring $user is defined by getting the currently authenticated user.
    
    //     return view('ticket.index', compact('tickets', 'user'));
    // }
    

    public function ticketsReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $tickets = Ticket::whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.ticket-reports', compact('tickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('ticket-reports-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
        
    }

    public function usersReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $users = User::whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.users-report', compact('users'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('users-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
        
    }

    public function faqsReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $faqs = FAQs::whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.faqs-report', compact('faqs'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('faqs-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
        
    }

    // public function userTicketsReport(Request $request, $userId)
    // {
    //     // Validate incoming request data
    //     $request->validate([
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date'
    //     ]);
    
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');
    
    //     // Parse dates using Carbon for better handling
    //     $formattedStartDate = Carbon::parse($start_date)->startOfDay();
    //     $formattedEndDate = Carbon::parse($end_date)->endOfDay();
    
    //     // Find user or fail
    //     $user = User::findOrFail($userId);
    
    //     // Get tickets for user within the specified date range
    //     $tickets = Ticket::where('user_id', $userId)
    //                      ->whereBetween('created_at', [$formattedStartDate, $formattedEndDate])
    //                      ->get();
    
    //     // Generate PDF
    //     $pdf = PDF::loadView('reports.user-tickets-report', compact('user', 'tickets'));
    
    //     // Stream the PDF back as response
    //     return $pdf->stream("user-tickets-report-{$userId}-{$formattedStartDate->toDateString()}-{$formattedEndDate->toDateString()}.pdf");
    // }
}
