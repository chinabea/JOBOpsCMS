<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MisRequestTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of sample data
        $requestTypes = [
            ['requestType_name' => 'Accounts', 'created_at' => now(), 'updated_at' => now()],
            ['requestType_name' => 'Systems', 'created_at' => now(), 'updated_at' => now()],
            ['requestType_name' => 'ID', 'created_at' => now(), 'updated_at' => now()],
            
        ];

        // Insert the data into the database
        DB::table('mis_request_types')->insert($requestTypes);
    
    }
}
