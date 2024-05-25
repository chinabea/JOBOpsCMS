<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'ictram_id' => 1,
                // 'ictram_equipment_id' => 1,
                //'ictram_problem_id' => 1,
                // 'nicmu_id' => 1,
                // // 'nicmu_equipment_id' => 1,
                // // 'nicmu_problem_id' => 1,
                // // 'mis_request_type_id' => 1,
                // 'mis_id' => 1,
                // //  'mis_asname_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 14)),
                'updated_at' => Carbon::now()->subDays(rand(1, 14)),
            ],
            [
                'building_number' => 'B2',
                'office_name' => 'Office B',
                'priority_level' => 'Mid',
                'description' => 'A mid priority issue in Office B.',
                'status' => 'In Progress',
                'user_id' => 2,
                'file_path' => 'uploads/file2.pdf',
                // 'ictram_id' => 1,
                // // 'ictram_equipment_id' => 1,
                // //'ictram_problem_id' => 1,
                'nicmu_id' => 1,
                // 'nicmu_equipment_id' => 1,
                // 'nicmu_problem_id' => 1,
                // // 'mis_request_type_id' => 1,
                // 'mis_id' => 1,
                // //  'mis_asname_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 14)),
                'updated_at' => Carbon::now()->subDays(rand(1, 14)),
            ],
            [
                'building_number' => 'B3',
                'office_name' => 'Office C',
                'priority_level' => 'Low',
                'description' => 'A low priority issue in Office C.',
                'status' => 'Closed',
                'user_id' => 3,
                'file_path' => null,
                // 'ictram_id' => 1,
                // // 'ictram_equipment_id' => 1,
                // //'ictram_problem_id' => 1,
                // 'nicmu_id' => 1,
                // // 'nicmu_equipment_id' => 1,
                // // 'nicmu_problem_id' => 1,
                // 'mis_request_type_id' => 1,
                'mis_id' => 1,
                //  'mis_asname_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 14)),
                'updated_at' => Carbon::now()->subDays(rand(1, 14)),
            ],
            [
                'building_number' => 'B1',
                'office_name' => 'Office A',
                'priority_level' => 'High',
                'description' => 'A high priority issue in Office A.',
                'status' => 'Open',
                'user_id' => 1,
                'file_path' => null,
                'ictram_id' => 1,
                // 'ictram_equipment_id' => 1,
                //'ictram_problem_id' => 1,
                // 'nicmu_id' => 1,
                // // 'nicmu_equipment_id' => 1,
                // // 'nicmu_problem_id' => 1,
                // // 'mis_request_type_id' => 1,
                // 'mis_id' => 1,
                // //  'mis_asname_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 14)),
                'updated_at' => Carbon::now()->subDays(rand(1, 14)),
            ],
            [
                'building_number' => 'B2',
                'office_name' => 'Office B',
                'priority_level' => 'Mid',
                'description' => 'A mid priority issue in Office B.',
                'status' => 'In Progress',
                'user_id' => 2,
                'file_path' => 'uploads/file2.pdf',
                // 'ictram_id' => 1,
                // // 'ictram_equipment_id' => 1,
                // //'ictram_problem_id' => 1,
                'nicmu_id' => 1,
                // 'nicmu_equipment_id' => 1,
                // 'nicmu_problem_id' => 1,
                // // 'mis_request_type_id' => 1,
                // 'mis_id' => 1,
                // //  'mis_asname_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 14)),
                'updated_at' => Carbon::now()->subDays(rand(1, 14)),
            ],
            [
                'building_number' => 'B3',
                'office_name' => 'Office C',
                'priority_level' => 'Low',
                'description' => 'A low priority issue in Office C.',
                'status' => 'Closed',
                'user_id' => 3,
                'file_path' => null,
                // 'ictram_id' => 1,
                // // 'ictram_equipment_id' => 1,
                // //'ictram_problem_id' => 1,
                // 'nicmu_id' => 1,
                // // 'nicmu_equipment_id' => 1,
                // // 'nicmu_problem_id' => 1,
                // 'mis_request_type_id' => 1,
                'mis_id' => 1,
                //  'mis_asname_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 14)),
                'updated_at' => Carbon::now()->subDays(rand(1, 14)),
            ],
        ];

        // Insert the data into the database
        DB::table('tickets')->insert($tickets);
    }
}
