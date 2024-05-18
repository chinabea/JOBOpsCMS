<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IctramEquipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of sample data
        $equipments = [
            ['equipment_name' => 'Printer', 'created_at' => now(), 'updated_at' => now()],
            ['equipment_name' => 'All in One PC', 'created_at' => now(), 'updated_at' => now()],
            ['equipment_name' => 'System Unit', 'created_at' => now(), 'updated_at' => now()],
            ['equipment_name' => 'Laptop', 'created_at' => now(), 'updated_at' => now()],

            // ['equipment_name' => 'Printer', 'ictram_job_type_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            // ['equipment_name' => 'All in One PC', 'ictram_job_type_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // ['equipment_name' => 'System Unit', 'ictram_job_type_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // ['equipment_name' => 'Laptop', 'ictram_job_type_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert the data into the database
        DB::table('ictram_equipments')->insert($equipments);
    }
}
