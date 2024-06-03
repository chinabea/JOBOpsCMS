<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officeNames = [
            ['office_name' => 'Records Office', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'CRD', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'SRRO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'Records Office', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'CEA Deans Office', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'Cashier', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'CIRL', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'COA', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'PRAAS', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'SRRO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'Legal Affairs Office', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'CAS Deans Office', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'CHS Faculty', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'HRMDO', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'Accounting Office', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'CTHBM Deans Office', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'OVPAA', 'created_at' => now(), 'updated_at' => now()],
            ['office_name' => 'PPFMS', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert the data into the database
        DB::table('office_names')->insert($officeNames);
    }
}
