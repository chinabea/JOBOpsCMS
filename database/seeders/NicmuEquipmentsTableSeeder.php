<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NicmuEquipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of sample data
        $equipments = [
            
            ['equipment_name' => 'Telephone', 'created_at' => now(), 'updated_at' => now()],
            ['equipment_name' => 'Internet', 'created_at' => now(), 'updated_at' => now()],
            ['equipment_name' => 'CCTV', 'created_at' => now(), 'updated_at' => now()],

            // ['equipment_name' => 'Telephone', 'nicmu_job_type_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            // ['equipment_name' => 'Internet', 'nicmu_job_type_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            // ['equipment_name' => 'CCTV', 'nicmu_job_type_id' => 3, 'created_at' => now(), 'updated_at' => now()],
          ];
       
        // Insert the data into the database
        DB::table('nicmu_equipments')->insert($equipments);
    
    }
}
