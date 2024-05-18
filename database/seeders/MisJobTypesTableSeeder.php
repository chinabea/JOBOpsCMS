<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MisJobTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of sample data
        $jobTypes = [

            
            // ['jobType_name' => 'New Account', 'created_at' => now(), 'updated_at' => now()],
            // ['jobType_name' => 'Reset Password', 'created_at' => now(), 'updated_at' => now()],
            // ['jobType_name' => 'Restrart', 'created_at' => now(), 'updated_at' => now()],
            // ['jobType_name' => 'Re-Installation', 'created_at' => now(), 'updated_at' => now()],
            // ['jobType_name' => 'Reactivation', 'created_at' => now(), 'updated_at' => now()],
            // ['jobType_name' => 'Restore', 'created_at' => now(), 'updated_at' => now()],

            ['jobType_name' => 'New Account', 'mis_request_type_id' => 1, 'asname_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Reset Password', 'mis_request_type_id' => 2, 'asname_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Restrart', 'mis_request_type_id' => 1, 'asname_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Re-Installation', 'mis_request_type_id' => 2, 'asname_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Reactivation', 'mis_request_type_id' => 1, 'asname_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['jobType_name' => 'Restore', 'mis_request_type_id' => 2, 'asname_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert the data into the database
        DB::table('mis_job_types')->insert($jobTypes);
    }
}
