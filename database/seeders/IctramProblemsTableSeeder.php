<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IctramProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of sample data
        $problems = [
            ['problem_description' => 'Paper Jams','created_at' => now(), 'updated_at' => now()],
            ['problem_description' => 'Poor Printing Quality','created_at' => now(), 'updated_at' => now()],

            ['problem_description' => 'Slow printing with wifi printers', 'created_at' => now(), 'updated_at' => now()],
            ['problem_description' => 'Wi-Fi Connectivity Problems', 'created_at' => now(), 'updated_at' => now()],
           
            ['problem_description' => 'Data Loss', 'created_at' => now(), 'updated_at' => now()],
            ['problem_description' => 'Virus and Malware Infections', 'created_at' => now(), 'updated_at' => now()],
            ['problem_description' => 'Gneneral Slowdown', 'created_at' => now(), 'updated_at' => now()],
            ['problem_description' => 'Not Turning On', 'created_at' => now(), 'updated_at' => now()],

            // ['problem_description' => 'Paper Jams', 'ictram_equipment_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            // ['problem_description' => 'Poor Printing Quality', 'ictram_equipment_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ['problem_description' => 'Slow printing with wifi printers', 'ictram_equipment_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            // ['problem_description' => 'Wi-Fi Connectivity Problems', 'ictram_equipment_id' => 2, 'created_at' => now(), 'updated_at' => now()],
           
            // ['problem_description' => 'Data Loss', 'ictram_equipment_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            // ['problem_description' => 'Virus and Malware Infections', 'ictram_equipment_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // ['problem_description' => 'Gneneral Slowdown', 'ictram_equipment_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // ['problem_description' => 'Not Turning On', 'ictram_equipment_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert the data into the database
        DB::table('ictram_problems')->insert($problems);
    }
}
