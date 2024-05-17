<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MisAsnamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of sample data
        $asnames = [
            ['name' => 'Office 365', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SIAS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'LeOns', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HRIS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'KOHA', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert the data into the database
        DB::table('mis_asnames')->insert($asnames);

    }
}
