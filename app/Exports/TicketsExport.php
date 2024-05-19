<?php

namespace App\Exports;

use App\Models\Ticket;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TicketsExport implements FromCollection, WithHeadings
{
    public function generateExcel()
    {
        $tickets = Ticket::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'User ID');
        $sheet->setCellValue('C1', 'Building Number');
        // Add more headers here...

        // Populate data
        $row = 2;
        foreach ($tickets as $ticket) {
            $sheet->setCellValue('A'.$row, $ticket->id);
            $sheet->setCellValue('B'.$row, $ticket->user_id);
            $sheet->setCellValue('C'.$row, $ticket->building_number);
            // Add more columns here...
            $row++;
        }

        // Save Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'tickets.xlsx';
        $writer->save(storage_path('app/' . $filename));

        return storage_path('app/' . $filename);
    }
    
}
