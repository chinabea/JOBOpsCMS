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

}
