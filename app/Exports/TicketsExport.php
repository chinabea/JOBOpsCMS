<?php

namespace App\Exports;

use App\Models\Ticket;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TicketsExport implements FromCollection, WithHeadings
{
    protected $tickets;

    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    public function generate()
    {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set active sheet index to the first sheet and get it
        $sheet = $spreadsheet->setActiveSheetIndex(0);

        // Set the headings
        $headings = [
            'ID', 'User ID', 'Building Number', 'Office Name', 'Priority Level',
            'Description', 'File Path', 'Status', 'Serial Number',
            'Covered Under Warranty', 'ICTRAM Job Type ID', 'ICTRAM Equipment ID',
            'ICTRAM Problem ID', 'NICMU Job Type ID', 'NICMU Equipment ID',
            'NICMU Problem ID', 'MIS Request Type ID', 'MIS Job Type ID',
            'MIS ASName ID', 'Created At', 'Updated At'
        ];

        // Add the headings to the first row
        $sheet->fromArray($headings, NULL, 'A1');

        // Add the data rows starting from the second row
        $rowNumber = 2;
        foreach ($this->tickets as $ticket) {
            $sheet->fromArray([
                $ticket->id,
                $ticket->user_id,
                $ticket->building_number,
                $ticket->office_name,
                $ticket->priority_level,
                $ticket->description,
                $ticket->file_path,
                $ticket->status,
                $ticket->serial_number,
                $ticket->covered_under_warranty,
                $ticket->ictram_job_type_id,
                $ticket->ictram_equipment_id,
                $ticket->ictram_problem_id,
                $ticket->nicmu_job_type_id,
                $ticket->nicmu_equipment_id,
                $ticket->nicmu_problem_id,
                $ticket->mis_request_type_id,
                $ticket->mis_job_type_id,
                $ticket->mis_asname_id,
                $ticket->created_at,
                $ticket->updated_at
            ], NULL, 'A' . $rowNumber);

            $rowNumber++;
        }

        // Write the file
        $writer = new Xlsx($spreadsheet);
        $filePath = 'tickets_export.xlsx';
        $writer->save($filePath);

        return $filePath;
    }

    
}
