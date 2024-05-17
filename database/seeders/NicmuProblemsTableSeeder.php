<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NicmuProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of sample data
        $problems = [
            ['problem_description' => 'Network Downtime', 'nicmu_equipment_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['problem_description' => 'Slow Internet Speed', 'nicmu_equipment_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['problem_description' => 'Network Congestion', 'nicmu_equipment_id' => 3, 'created_at' => now(), 'updated_at' => now()],
          ];

       
        // Insert the data into the database
        DB::table('nicmu_problems')->insert($problems);
    
    }
}
