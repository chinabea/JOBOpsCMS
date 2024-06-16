<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\User;
use App\Models\FAQs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Report; 
use App\Models\BuildingNumber; 
use App\Services\ReportService;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Dompdf\Dompdf;
use Dompdf\Options;
use Storage;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ticketReport(Request $request)
    {
        // Eager load relationships: 'ictram', 'nicmu', 'mis'
        $tickets = Ticket::with(['ictram', 'nicmu', 'mis']);

        // Apply search filter
        if ($request->filled('search')) {
            $tickets->where(function($query) use ($request) {
                $query->where('priority_level', 'like', '%' . $request->search . '%')
                    ->orWhere('status', 'like', '%' . $request->search . '%');
            });
        }

        // Apply building number filter
        if ($request->filled('building_number_id')) {
            $tickets->where('building_number_id', $request->building_number_id);
        }

        // Apply priority level filter
        if ($request->filled('priority_level')) {
            $tickets->where('priority_level', $request->priority_level);
        }

        // Apply status filter
        if ($request->filled('status')) {
            $tickets->where('status', $request->status);
        }

        // Apply date filters
        if ($request->filled('start_date')) {
            $tickets->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $tickets->whereDate('created_at', '<=', $request->end_date);
        }

        // Get the filtered and sorted tickets
        $tickets = $tickets->get();

        // Additional data you may want to load
        $userIds = User::where('role', 2)->where('is_approved', true)->pluck('id', 'name');
        $buildingNumbers = BuildingNumber::all();

        // Check for export requests
        if ($request->has('export')) {
            if ($request->export == 'excel') {
                return $this->exportExcel($tickets); // Assuming exportExcel method handles exporting tickets to Excel
            } elseif ($request->export == 'pdf') {
                return $this->exportPdf($tickets); // Assuming exportPdf method handles exporting tickets to PDF
            }
        }

        return view('reports.ticket', compact('tickets', 'userIds', 'buildingNumbers'));
    }

    public function filteredTickets(Request $request)
    {
        $query = Ticket::query();

        // Apply filters
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                // $q->where('building_number', 'like', '%' . $request->search . '%')
                $q->Where('priority_level', 'like', '%' . $request->search . '%')
                ->orWhere('status', 'like', '%' . $request->search . '%');
            });
        }
        // Apply building number filter
        if ($request->filled('building_number_id')) {
            $tickets->where('building_number_id', $request->building_number_id);
        }
        if ($request->filled('priority_level')) {
            $query->where('priority_level', $request->priority_level);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('sort_by') && $request->filled('sort_order')) {
            $query->orderBy($request->sort_by, $request->sort_order);
        }

        return $query->get();
    }

    public function exportExcel(Collection $tickets)
    {
        // Create a new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Merge cells for the header
        $sheet->mergeCells('A1:N1');
        $sheet->mergeCells('A2:N2');
        $sheet->mergeCells('A3:N3');
        $sheet->mergeCells('A4:N4');
        $sheet->mergeCells('A5:N5');
        $sheet->mergeCells('A6:N6');
        $sheet->mergeCells('A7:N7');

        // Set the header text
        $sheet->setCellValue('A1', "Republic of the Philippines");
        $sheet->setCellValue('A2', "CAMARINES SUR POLYTECHNIC COLLEGES");
        $sheet->setCellValue('A3', "Nabua, Camarines Sur");
        $sheet->setCellValue('A5', "INFORMATION AND COMMUNICATIONS TECHNOLOGY UNIT");
        $sheet->setCellValue('A6', "SUMMARY OF REQUESTS");

        // Load the logo image
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('dist/img/CSPC-Logo.jpg')); 
        $drawing->setHeight(90);
        $drawing->setCoordinates('F1');
        $drawing->setOffsetX(170); // Adjust the offset to center the logo
        $drawing->setWorksheet($sheet);

        // Format the header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        $sheet->getStyle('A1:N8')->applyFromArray($headerStyle);
        
        // Add column headers
        $sheet->setCellValue('A8', 'No.');
        $sheet->setCellValue('B8', 'REQUESITOR');
        $sheet->setCellValue('C8', 'Building Number');
        $sheet->setCellValue('D8', 'Office');
        $sheet->setCellValue('E8', 'Priority Level');
        $sheet->setCellValue('F8', 'Unit Request');
        $sheet->setCellValue('G8', 'Job Type');
        $sheet->setCellValue('H8', 'Service for');
        $sheet->setCellValue('I8', 'Issues or Concern');
        $sheet->setCellValue('J8', 'Description');
        $sheet->setCellValue('K8', 'Status');
        $sheet->setCellValue('L8', 'Serial Number');
        $sheet->setCellValue('M8', 'Warranty Number');
        $sheet->setCellValue('N8', 'Date Requested');

        // Format column headers
        $columnHeaderStyle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A8:N8')->applyFromArray($columnHeaderStyle);

        // Populate the spreadsheet with data
        $row = 9;
        $index = 1;
        foreach ($tickets as $ticket) {
            $sheet->setCellValue('A' . $row, $index);
            $sheet->setCellValue('B' . $row, $ticket->user->name);
            $sheet->setCellValue('C' . $row, $ticket->buildingNumber->building_number);
            $sheet->setCellValue('D' . $row, $ticket->officeName->office_name);
            $sheet->setCellValue('E' . $row, $ticket->priority_level);

            if ($ticket->ictram) {
                $sheet->setCellValue('F' . $row, 'ICTRAM');
                $sheet->setCellValue('G' . $row, $ticket->ictram->jobType->jobType_name);
                $sheet->setCellValue('H' . $row, $ticket->ictram->equipment->equipment_name);
                $sheet->setCellValue('I' . $row, $ticket->ictram->problem->problem_description);
            }

            if ($ticket->nicmu) {
                $sheet->setCellValue('F' . $row, 'NICMU');
                $sheet->setCellValue('G' . $row, $ticket->nicmu->jobType->jobType_name);
                $sheet->setCellValue('H' . $row, $ticket->nicmu->equipment->equipment_name);
                $sheet->setCellValue('I' . $row, $ticket->nicmu->problem->problem_description);
            }

            if ($ticket->mis) {
                $sheet->setCellValue('F' . $row, 'MIS');
                $sheet->setCellValue('G' . $row, $ticket->mis->jobType->jobType_name);
                $sheet->setCellValue('H' . $row, $ticket->mis->asName->name);
                $sheet->setCellValue('I' . $row, $ticket->mis->requestTypeName->requestType_name);
            }

            $sheet->setCellValue('J' . $row, $ticket->description);
            $sheet->setCellValue('K' . $row, $ticket->status);
            $sheet->setCellValue('L' . $row, $ticket->serial_number);
            $sheet->setCellValue('M' . $row, $ticket->covered_under_warranty ? 'Yes' : 'No');
            $sheet->setCellValue('N' . $row, $ticket->created_at);
            $row++;
            $index++;
        }

        // Adjust column widths
        foreach (range('A', 'N') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate and save the spreadsheet to a file
        $writer = new Xlsx($spreadsheet);
        $filePath = storage_path('app/public/tickets.xlsx');
        $writer->save($filePath);

        // Return the file as a response to the user
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    // public function exportExcel(Collection $tickets)
    // {
    
    //     // Create a new spreadsheet
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     // Merge cells for the header
    //     $sheet->mergeCells('A1:J1');
    //     $sheet->mergeCells('A2:J2');
    //     $sheet->mergeCells('A3:J3');
    //     $sheet->mergeCells('A4:J4');
    //     $sheet->mergeCells('A5:J5');
    //     $sheet->mergeCells('A6:J6');
    //     $sheet->mergeCells('A7:J7');

    //     // Set the header text
    //     $sheet->setCellValue('A1', "Republic of the Philippines");
    //     $sheet->setCellValue('A2', "CAMARINES SUR POLYTECHNIC COLLEGES");
    //     $sheet->setCellValue('A3', "Nabua, Camarines Sur");
    //     $sheet->setCellValue('A5', "MANAGEMENT INFORMATION AND COMMUNICATIONS TECHNOLOGY");
    //     $sheet->setCellValue('A6', "SUMMARY LIST OF JOB ORDER REQUEST FORM");
    //     $sheet->setCellValue('A7', "ICT REPAIR AND INSTALLATION\nfor the Month of January 2024");

    //     // Load the logo image
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath(public_path('dist/img/CSPC-Logo.jpg')); 
    //     $drawing->setHeight(50);
    //     $drawing->setCoordinates('A1');
    //     $drawing->setOffsetX(1000); // Adjust the offset to center the logo
    //     $drawing->setWorksheet($sheet);

    //     // Format the header
    //     $headerStyle = [
    //         'font' => [
    //             'bold' => true,
    //             'size' => 14,
    //         ],
    //         'alignment' => [
    //             'horizontal' => Alignment::HORIZONTAL_CENTER,
    //             'vertical' => Alignment::VERTICAL_CENTER,
    //             'wrapText' => true,
    //         ],
    //     ];
    //     $sheet->getStyle('A1:J7')->applyFromArray($headerStyle);

    //     // Add column headers
    //     $sheet->setCellValue('A8', 'No.');
    //     $sheet->setCellValue('B8', 'REQUESITOR');
    //     $sheet->setCellValue('C8', 'Building Number');
    //     $sheet->setCellValue('D8', 'Office');
    //     $sheet->setCellValue('E8', 'Priority Level');
    //     $sheet->setCellValue('F8', 'Unit Request');
    //     $sheet->setCellValue('G8', 'Job Type');
    //     $sheet->setCellValue('H8', 'Service for');
    //     $sheet->setCellValue('I8', 'Issues or Concern');
    //     $sheet->setCellValue('J8', 'Description');
    //     $sheet->setCellValue('K8', 'Status');
    //     $sheet->setCellValue('L8', 'Serial Number');
    //     $sheet->setCellValue('M8', 'Warranty Number');
    //     $sheet->setCellValue('N8', 'Date Requested');

    //     // Format column headers
    //     $columnHeaderStyle = [
    //         'font' => [
    //             'bold' => true,
    //         ],
    //         'alignment' => [
    //             'horizontal' => Alignment::HORIZONTAL_CENTER,
    //             'vertical' => Alignment::VERTICAL_CENTER,
    //         ],
    //         'borders' => [
    //             'allBorders' => [
    //                 'borderStyle' => Border::BORDER_THIN,
    //             ],
    //         ],
    //     ];
    //     $sheet->getStyle('A8:J8')->applyFromArray($columnHeaderStyle);

    //     // Populate the spreadsheet with data
    //     $row = 9;
    //     $index = 1;
    //     foreach ($tickets as $ticket) {
    //         $sheet->setCellValue('A' . $row, $index);
    //         $sheet->setCellValue('B' . $row, $ticket->user->name);
    //         $sheet->setCellValue('C' . $row, $ticket->buildingNumber->building_number);
    //         $sheet->setCellValue('D' . $row, $ticket->officeName->office_name);
    //         $sheet->setCellValue('E' . $row, $ticket->priority_level);
    //         if($ticket->ictram){
    //             $sheet->setCellValue('F' . $row, 'ICTRAM');
    //             $sheet->setCellValue('G' . $row, $ticket->ictram->jobType->jobType_name);
    //             $sheet->setCellValue('H' . $row, $ticket->ictram->equipment->equipment_name);
    //             $sheet->setCellValue('I' . $row, $ticket->ictram->problem->problem_description);
    //         }
    //         if($ticket->nicmu){
    //             $sheet->setCellValue('F' . $row, 'NICMU');
    //             $sheet->setCellValue('G' . $row, $ticket->nicmu->jobType->jobType_name);
    //             $sheet->setCellValue('H' . $row, $ticket->nicmu->equipment->equipment_name);
    //             $sheet->setCellValue('I' . $row, $ticket->nicmu->problem->problem_description);
    //         }
    //         if($ticket->mis){
    //             $sheet->setCellValue('F' . $row, 'MIS');
    //             $sheet->setCellValue('G' . $row, $ticket->mis->jobType->jobType_name);
    //             $sheet->setCellValue('H' . $row, $ticket->mis->asName->name);
    //             $sheet->setCellValue('I' . $row, $ticket->mis->requestTypeName->requestType_name);
    //         }
    //         $sheet->setCellValue('J' . $row, $ticket->description);
    //         $sheet->setCellValue('K' . $row, $ticket->status);
    //         $sheet->setCellValue('L' . $row, $ticket->serial_number);
    //         $sheet->setCellValue('M' . $row, $ticket->covered_under_warranty ? 'Yes' : 'No');
    //         $sheet->setCellValue('N' . $row, $ticket->created_at);
    //         $row++;
    //         $index++;
    //     }

    //     // Adjust column widths
    //     foreach (range('A', 'J') as $columnID) {
    //         $sheet->getColumnDimension($columnID)->setAutoSize(true);
    //     }

    //     // Generate and save the spreadsheet to a file
    //     $writer = new Xlsx($spreadsheet);
    //     $filePath = storage_path('app/public/tickets.xlsx');
    //     $writer->save($filePath);

    //     // Return the file as a response to the user
    //     return response()->download($filePath)->deleteFileAfterSend(true);
    // }

    public function exportPdf(Collection $tickets)
    {
        // Generate the HTML content for the PDF
        $html = view('reports.report-pdf', compact('tickets'))->render();
    
        // Configure Dompdf options as an array
        $options = [
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, // Enable remote file access (for images, etc.)
        ];
    
        // Initialize Dompdf with the options
        PDF::setOptions($options);
    
        // Load HTML into Dompdf
        $dompdf = PDF::loadHTML($html);
    
        // Set paper size and orientation if needed
        $dompdf->setPaper('A4', 'landscape');
    
        // Render PDF (important for fonts and styles to be applied)
        $dompdf->render();
    
        // Return the PDF as a download response
        return $dompdf->stream('tickets.pdf');
    }


























    // -----------------------------------------------------------------------------------------------------------------

    public function unassignedReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        

        $unassignedTickets = Ticket::doesntHave('users')->whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.unassigned-report', compact('unassignedTickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('unassigned-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
    }

    public function closedReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $tickets = Ticket::where('status', 'Closed')->whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.closed-report', compact('tickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('closed-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
    }

    public function inProgressReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $tickets = Ticket::where('status', 'In Progress')->whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.in-progress-report', compact('tickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('in-progress-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
    }

    public function openReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $tickets = Ticket::where('status', 'Open')->whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.open-report', compact('tickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('open-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
    }

    public function ticketsReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $tickets = Ticket::whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.tickets-reports', compact('tickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('tickets-reports-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
        
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

    public function highReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $tickets = Ticket::where('priority_level', 'High')->whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.high-report', compact('tickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('high-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
    }

    public function midReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $tickets = Ticket::where('priority_level', 'Mid')->whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.mid-report', compact('tickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('mid-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
    }

    public function lowReport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        // Adjust database query to filter records based on the date range
        $tickets = Ticket::where('priority_level', 'Low')->whereBetween('created_at', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('reports.low-report', compact('tickets'));

        // Validate the date range
        $formattedStartDate = Carbon::parse($start_date)->startOfDay();
        $formattedEndDate = Carbon::parse($end_date)->endOfDay();
        
        return $pdf->stream('low-report-' . $formattedStartDate . '-' . $formattedEndDate . '.pdf');
    }
}
