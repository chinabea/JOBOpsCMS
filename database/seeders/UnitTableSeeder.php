<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed MIS Request Types
        DB::table('ictram')->insert([
            ['ictram_job_type_id' => 1, 'ictram_equipment_id' => 2, 'ictram_problem_id' => 3],
            ['ictram_job_type_id' => 2, 'ictram_equipment_id' => 1, 'ictram_problem_id' => 1],
            ['ictram_job_type_id' => 3, 'ictram_equipment_id' => 2, 'ictram_problem_id' => 2],
            ['ictram_job_type_id' => 1, 'ictram_equipment_id' => 1, 'ictram_problem_id' => 3],
            // Add more request types as needed
        ]);
        

        DB::table('nicmu')->insert([
            ['nicmu_job_type_id' => 1, 'nicmu_equipment_id' => 2, 'nicmu_problem_id' => 3],
            ['nicmu_job_type_id' => 2, 'nicmu_equipment_id' => 1, 'nicmu_problem_id' => 1],
            ['nicmu_job_type_id' => 3, 'nicmu_equipment_id' => 2, 'nicmu_problem_id' => 2],
            ['nicmu_job_type_id' => 1, 'nicmu_equipment_id' => 1, 'nicmu_problem_id' => 3],
            // Add more equipments as needed
        ]);
        

        DB::table('mis')->insert([
            ['mis_request_type_id' => 1, 'mis_job_type_id' => 2, 'mis_asname_id' => 3],
            ['mis_request_type_id' => 2, 'mis_job_type_id' => 1, 'mis_asname_id' => 1],
            ['mis_request_type_id' => 3, 'mis_job_type_id' => 2, 'mis_asname_id' => 2],
            ['mis_request_type_id' => 1, 'mis_job_type_id' => 1, 'mis_asname_id' => 3],
            // Add more equipments as needed
        ]);
        

    }
}
