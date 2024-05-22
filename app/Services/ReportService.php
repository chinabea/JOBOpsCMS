<?php

namespace App\Services;

use App\Models\Ticket;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function getTickets($search = null, $sortField = null, $sortOrder = 'asc')
    {
        $query = DB::table('tickets');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('building_number', 'like', "%{$search}%")
                  ->orWhere('office_name', 'like', "%{$search}%")
                  ->orWhere('priority_level', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%");
            });
        }

        if ($sortField) {
            $query->orderBy($sortField, $sortOrder);
        }

        return $query->get();
    }

    public function generateExcelReport($search = null, $sortField = null, $sortOrder = 'asc')
    {
        $tickets = $this->getTickets($search, $sortField, $sortOrder);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'User ID');
        $sheet->setCellValue('C1', 'Building Number');
        $sheet->setCellValue('D1', 'Office Name');
        $sheet->setCellValue('E1', 'Priority Level');
        $sheet->setCellValue('F1', 'Description');
        $sheet->setCellValue('G1', 'File Path');
        $sheet->setCellValue('H1', 'Status');
        $sheet->setCellValue('I1', 'Serial Number');
        $sheet->setCellValue('J1', 'Covered Under Warranty');

        $row = 2;
        foreach ($tickets as $ticket) {
            $sheet->setCellValue('A' . $row, $ticket->id);
            $sheet->setCellValue('B' . $row, $ticket->user_id);
            $sheet->setCellValue('C' . $row, $ticket->building_number);
            $sheet->setCellValue('D' . $row, $ticket->office_name);
            $sheet->setCellValue('E' . $row, $ticket->priority_level);
            $sheet->setCellValue('F' . $row, $ticket->description);
            $sheet->setCellValue('G' . $row, $ticket->file_path);
            $sheet->setCellValue('H' . $row, $ticket->status);
            $sheet->setCellValue('I' . $row, $ticket->serial_number);
            $sheet->setCellValue('J' . $row, $ticket->covered_under_warranty);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'tickets_report.xlsx';
        $writer->save($fileName);

        return $fileName;
    }

    public function generatePdfReport($search = null, $sortField = null, $sortOrder = 'asc')
    {
        $tickets = $this->getTickets($search, $sortField, $sortOrder);

        $html = view('reports.tickets', compact('tickets'))->render();

        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $output = $dompdf->output();
        $fileName = 'tickets_report.pdf';
        file_put_contents($fileName, $output);

        return $fileName;
    }
}
