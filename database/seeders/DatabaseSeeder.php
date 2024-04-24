<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Ticket;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        $users = [
            [
                'name' => 'China Bea',
                'email' => 'chibea@my.cspc.edu.ph',
                'role' => 1,
                'is_approved' => true,
            ],
            [
                'name' => 'JESSICA MATAYA',
                'email' => 'jesmataya@my.cspc.edu.ph',
                'role' => 2,
                'is_approved' => true,
            ],
            [
                'name' => 'John Carlo Dacara',
                'email' => 'johdacara@my.cspc.edu.ph',
                'role' => 2,
                'is_approved' => true,
            ],
            // [
            //     'user_id' => '4',
            //     'email' => 'mlodavar@my.cspc.edu.ph',
            //     'role' => 1,
            // ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        
        $tickets = [
            
            [
                'user_id' => 3,
                'service_location' => 'Academic Building V',
                'unit' => 'MIS',
                'request' => 'Damage Printer',
                'description' => 'Printer Damage Damage Damage Printer Printer',
                'priority_level' => 'High',
                'deadline' => Carbon::create(2023, 12, 22),
                'status' => 'Open',
                'assigned_to' => 2
            ],
            [
                'user_id' => 3,
                'service_location' => 'Cashier Office',
                'unit' => 'MIT',
                'request' => 'aircon',
                'description' => 'Damage Damage Printer Printer',
                'priority_level' => 'Mid',
                'deadline' => Carbon::create(2023, 12, 22),
                'status' => 'In Progress',
                'assigned_to' => 2
            ],
            [
                'user_id' => 3,
                'service_location' => 'Office',
                'unit' => 'Repair',
                'request' => 'ID issues',
                'description' => 'Need for Repair',
                'priority_level' => 'High',
                'deadline' => Carbon::create(2023, 02, 22),
                'status' => 'Closed',
                'assigned_to' => 2
            ],
            [
                'user_id' => 3,
                'service_location' => 'Cashier',
                'unit' => 'Repair',
                'request' => 'Repair',
                'description' => 'Damage',
                'priority_level' => 'Mid',
                'deadline' => Carbon::create(2023, 10, 27),
                'status' => 'In Progress',
                'assigned_to' => 2
            ],
            
            [
                'user_id' => 3,
                'service_location' => 'Academic Building V',
                'unit' => 'MIS',
                'request' => 'Damage Printer',
                'description' => 'Printer Damage Damage Damage Printer Printer',
                'priority_level' => 'High',
                'deadline' => Carbon::create(2023, 12, 22),
                'status' => 'Open',
                'assigned_to' => 2
            ],
            [
                'user_id' => 3,
                'service_location' => 'Cashier Office',
                'unit' => 'MIT',
                'request' => 'aircon',
                'description' => 'Damage Damage Printer Printer',
                'priority_level' => 'Mid',
                'deadline' => Carbon::create(2023, 12, 22),
                'status' => 'In Progress',
                'assigned_to' => 2
            ],
            [
                'user_id' => 3,
                'service_location' => 'Office',
                'unit' => 'Repair',
                'request' => 'ID issues',
                'description' => 'Need for Repair',
                'priority_level' => 'High',
                'deadline' => Carbon::create(2023, 02, 22),
                'status' => 'Closed',
                'assigned_to' => 2
            ],
        ];

        foreach ($tickets as $ticketData) {
            Ticket::create($ticketData);
        }














    }
}
