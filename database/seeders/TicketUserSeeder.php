<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TicketUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert sample data into the ticket_user table
        DB::table('ticket_user')->insert([
            [
                'ticket_id' => 1,
                'user_id' => 1,
                'escalationReason_for_workloadLimitReached' => 'High workload',
                'escalatedBy_for_workloadLimitReached' => 2,
                'escalationReasonDue_to_clientNoncompliance' => null,
                'clientNoncomplianceFile' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_id' => 2,
                'user_id' => 2,
                'escalationReason_for_workloadLimitReached' => null,
                'escalatedBy_for_workloadLimitReached' => null,
                'escalationReasonDue_to_clientNoncompliance' => 'Non-payment',
                'clientNoncomplianceFile' => 'nonpayment_evidence.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_id' => 3,
                'user_id' => 3,
                'escalationReason_for_workloadLimitReached' => 'Resource shortage',
                'escalatedBy_for_workloadLimitReached' => 4,
                'escalationReasonDue_to_clientNoncompliance' => 'Missed deadlines',
                'clientNoncomplianceFile' => 'missed_deadlines_report.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_id' => 4,
                'user_id' => 4,
                'escalationReason_for_workloadLimitReached' => 'High workload',
                'escalatedBy_for_workloadLimitReached' => 2,
                'escalationReasonDue_to_clientNoncompliance' => null,
                'clientNoncomplianceFile' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_id' => 5,
                'user_id' => 5,
                'escalationReason_for_workloadLimitReached' => null,
                'escalatedBy_for_workloadLimitReached' => null,
                'escalationReasonDue_to_clientNoncompliance' => 'Non-payment',
                'clientNoncomplianceFile' => 'nonpayment_evidence.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_id' => 6,
                'user_id' => 6,
                'escalationReason_for_workloadLimitReached' => 'Resource shortage',
                'escalatedBy_for_workloadLimitReached' => 4,
                'escalationReasonDue_to_clientNoncompliance' => 'Missed deadlines',
                'clientNoncomplianceFile' => 'missed_deadlines_report.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_id' => 7,
                'user_id' => 7,
                'escalationReason_for_workloadLimitReached' => 'High workload',
                'escalatedBy_for_workloadLimitReached' => 2,
                'escalationReasonDue_to_clientNoncompliance' => null,
                'clientNoncomplianceFile' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_id' => 8,
                'user_id' => 8,
                'escalationReason_for_workloadLimitReached' => null,
                'escalatedBy_for_workloadLimitReached' => null,
                'escalationReasonDue_to_clientNoncompliance' => 'Non-payment',
                'clientNoncomplianceFile' => 'nonpayment_evidence.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ticket_id' => 9,
                'user_id' => 9,
                'escalationReason_for_workloadLimitReached' => 'Resource shortage',
                'escalatedBy_for_workloadLimitReached' => 4,
                'escalationReasonDue_to_clientNoncompliance' => 'Missed deadlines',
                'clientNoncomplianceFile' => 'missed_deadlines_report.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
