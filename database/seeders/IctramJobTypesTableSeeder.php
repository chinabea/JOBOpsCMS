<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IctramJobTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of sample data
        $jobTypes = [
            ['jobType_name' => 'Installation', 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Repair', 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Software Upgrade', 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Preventive Maintenance', 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Corrective Maintenance', 'created_at' => now(), 'updated_at' => now()],
            
        ];

        // Insert the data into the database
        DB::table('ictram_job_types')->insert($jobTypes);
        
    }
}
