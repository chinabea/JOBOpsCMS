<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of sample data
        $tickets = [
            [
                'building_number' => 'B1',
                'office_name' => 'Office A',
                'priority_level' => 'High',
                'description' => 'A high priority issue in Office A.',
                'status' => 'Open',
                'user_id' => 1,
                'file_path' => null,
                'ictram_job_type_id' => null,
                'ictram_equipment_id' => null,
                'ictram_problem_id' => null,
                'nicmu_job_type_id' => 1,
                'nicmu_equipment_id' => 1,
                'nicmu_problem_id' => 1,
                'mis_request_type_id' => null,
                'mis_job_type_id' => null,
                'mis_asname_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'building_number' => 'B2',
                'office_name' => 'Office B',
                'priority_level' => 'Mid',
                'description' => 'A mid priority issue in Office B.',
                'status' => 'In Progress',
                'user_id' => 2,
                'file_path' => 'uploads/file2.pdf',
                'ictram_job_type_id' => null,
                'ictram_equipment_id' => null,
                'ictram_problem_id' => null,
                'nicmu_job_type_id' => null,
                'nicmu_equipment_id' => null,
                'nicmu_problem_id' => null,
                'mis_request_type_id' => 2,
                'mis_job_type_id' => 2,
                'mis_asname_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'building_number' => 'B3',
                'office_name' => 'Office C',
                'priority_level' => 'Low',
                'description' => 'A low priority issue in Office C.',
                'status' => 'Closed',
                'user_id' => 3,
                'file_path' => null,
                'ictram_job_type_id' => 3,
                'ictram_equipment_id' => 3,
                'ictram_problem_id' => 3,
                'nicmu_job_type_id' => null,
                'nicmu_equipment_id' => null,
                'nicmu_problem_id' => null,
                'mis_request_type_id' => null,
                'mis_job_type_id' => null,
                'mis_asname_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'building_number' => 'B1',
                'office_name' => 'Office A',
                'priority_level' => 'High',
                'description' => 'A high priority issue in Office A.',
                'status' => 'Open',
                'user_id' => 1,
                'file_path' => null,
                'ictram_job_type_id' => 1,
                'ictram_equipment_id' => 1,
                'ictram_problem_id' => 1,
                'nicmu_job_type_id' => null,
                'nicmu_equipment_id' => null,
                'nicmu_problem_id' => null,
                'mis_request_type_id' => null,
                'mis_job_type_id' => null,
                'mis_asname_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'building_number' => 'B2',
                'office_name' => 'Office B',
                'priority_level' => 'Mid',
                'description' => 'A mid priority issue in Office B.',
                'status' => 'In Progress',
                'user_id' => 2,
                'file_path' => 'uploads/file2.pdf',
                'ictram_job_type_id' => null,
                'ictram_equipment_id' => null,
                'ictram_problem_id' => null,
                'nicmu_job_type_id' => 2,
                'nicmu_equipment_id' => 2,
                'nicmu_problem_id' => 2,
                'mis_request_type_id' => null,
                'mis_job_type_id' => null,
                'mis_asname_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'building_number' => 'B3',
                'office_name' => 'Office C',
                'priority_level' => 'Low',
                'description' => 'A low priority issue in Office C.',
                'status' => 'Closed',
                'user_id' => 3,
                'file_path' => null,
                'ictram_job_type_id' => null,
                'ictram_equipment_id' => null,
                'ictram_problem_id' => null,
                'nicmu_job_type_id' => null,
                'nicmu_equipment_id' => null,
                'nicmu_problem_id' => null,
                'mis_request_type_id' => 3,
                'mis_job_type_id' => 3,
                'mis_asname_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the data into the database
        DB::table('tickets')->insert($tickets);
    }
}
