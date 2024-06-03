<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingNumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data to seed
        $buildingNumbers = [
            ['building_number' => 'Academic Building 1', 'created_at' => now(), 'updated_at' => now()],
            ['building_number' => 'Academic Building 2', 'created_at' => now(), 'updated_at' => now()],
            ['building_number' => 'Academic Building 3', 'created_at' => now(), 'updated_at' => now()],
            ['building_number' => 'Academic Building 4', 'created_at' => now(), 'updated_at' => now()],
            ['building_number' => 'Academic Building 5', 'created_at' => now(), 'updated_at' => now()],
            // Add more data as needed
        ];

        // Insert data into the 'building_numbers' table
        DB::table('building_numbers')->insert($buildingNumbers);
    }
}
