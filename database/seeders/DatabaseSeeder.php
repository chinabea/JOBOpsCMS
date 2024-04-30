<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Ticket;
use Carbon\Carbon;
use Faker\Factory as Faker;

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
                'phone_number' => '09246794618',
                'job_position' => 'Software Devs',
                'expertise' => 'Software Developer',
            ],
            [
                'name' => 'JESSICA MATAYA',
                'email' => 'jesmataya@my.cspc.edu.ph',
                'role' => 2,
                'is_approved' => true,
                'phone_number' => '09386390756',
                'job_position' => 'Admin Aide 1',
                'expertise' => 'Networking',
            ],
            [
                'name' => 'John Carlo Dacara',
                'email' => 'johdacara@my.cspc.edu.ph',
                'role' => null,
                'is_approved' => false,
                'phone_number' => null,
                'job_position' => null,
                'expertise' => null,
                
            ],
            [
                'name' => 'Mark Louis Odavar',
                'email' => 'mlodavar@my.cspc.edu.ph',
                'role' => null,
                'is_approved' => false,
                'phone_number' => null,
                'job_position' => null,
                'expertise' => null,
                
            ],
            [
                'name' => 'Jessemri Tabayag',
                'email' => 'jestabayag@my.cspc.edu.ph',
                'role' => null,
                'is_approved' => false,
                'phone_number' => null,
                'job_position' => null,
                'expertise' => null,
                
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
        
        $faker = Faker::create();
        $users = User::pluck('id')->toArray(); // Get all user IDs from the User table
        $priorityLevels = ['High', 'Mid', 'Low'];
        $statusOptions = ['Open', 'In Progress', 'Closed'];

        for ($i = 0; $i < 70; $i++) { // Generate 50 tickets
            $randomTimestamp = $faker->dateTimeBetween('-1 years', 'now');


            Ticket::create([
                'user_id'          => $faker->randomElement($users),
                'service_location' => $faker->streetAddress,
                'unit'             => $faker->word,
                'request'          => $faker->sentence,
                'priority_level'   => $faker->randomElement($priorityLevels),
                'deadline'         => $faker->date(),
                'description'      => $faker->paragraph($nbSentences = 1, $variableNbSentences = true), // Limiting to 3 sentences
                // 'assigned_to'      => $faker->randomElement($users + [null]), // Random user or null
                'file_path'        => $faker->randomElement([$faker->imageUrl(), null]), // Random image URL or null
                'status'           => $faker->randomElement($statusOptions),
                'created_at'       => $randomTimestamp, // Random creation date within the last two years
                'updated_at'       => $randomTimestamp  // Ensures created_at and updated_at are the same
            ]);
        }

        
        // $tickets = [
            
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Academic Building V',
        //         'unit' => 'MIS',
        //         'request' => 'Damage Printer',
        //         'description' => 'Printer Damage Damage Damage Printer Printer',
        //         'priority_level' => 'High',
        //         'deadline' => Carbon::create(2023, 12, 22),
        //         'status' => 'Open',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Cashier Office',
        //         'unit' => 'MIT',
        //         'request' => 'aircon',
        //         'description' => 'Damage Damage Printer Printer',
        //         'priority_level' => 'Mid',
        //         'deadline' => Carbon::create(2023, 12, 22),
        //         'status' => 'In Progress',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Office',
        //         'unit' => 'Repair',
        //         'request' => 'ID issues',
        //         'description' => 'Need for Repair',
        //         'priority_level' => 'High',
        //         'deadline' => Carbon::create(2023, 02, 22),
        //         'status' => 'Closed',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Cashier',
        //         'unit' => 'Repair',
        //         'request' => 'Repair',
        //         'description' => 'Damage',
        //         'priority_level' => 'Mid',
        //         'deadline' => Carbon::create(2023, 10, 27),
        //         'status' => 'In Progress',
        //         'assigned_to' => 2
        //     ],
            
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Academic Building V',
        //         'unit' => 'MIS',
        //         'request' => 'Damage Printer',
        //         'description' => 'Printer Damage Damage Damage Printer Printer',
        //         'priority_level' => 'High',
        //         'deadline' => Carbon::create(2023, 12, 22),
        //         'status' => 'Open',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Cashier Office',
        //         'unit' => 'MIT',
        //         'request' => 'aircon',
        //         'description' => 'Damage Damage Printer Printer',
        //         'priority_level' => 'Mid',
        //         'deadline' => Carbon::create(2023, 12, 22),
        //         'status' => 'In Progress',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Office',
        //         'unit' => 'Repair',
        //         'request' => 'ID issues',
        //         'description' => 'Need for Repair',
        //         'priority_level' => 'High',
        //         'deadline' => Carbon::create(2023, 02, 22),
        //         'status' => 'Closed',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Academic Building V',
        //         'unit' => 'MIS',
        //         'request' => 'Damage Printer',
        //         'description' => 'Printer Damage Damage Damage Printer Printer',
        //         'priority_level' => 'High',
        //         'deadline' => Carbon::create(2023, 12, 22),
        //         'status' => 'Open',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Cashier Office',
        //         'unit' => 'MIT',
        //         'request' => 'aircon',
        //         'description' => 'Damage Damage Printer Printer',
        //         'priority_level' => 'Mid',
        //         'deadline' => Carbon::create(2023, 12, 22),
        //         'status' => 'In Progress',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Office',
        //         'unit' => 'Repair',
        //         'request' => 'ID issues',
        //         'description' => 'Need for Repair',
        //         'priority_level' => 'High',
        //         'deadline' => Carbon::create(2023, 02, 22),
        //         'status' => 'Closed',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Cashier',
        //         'unit' => 'Repair',
        //         'request' => 'Repair',
        //         'description' => 'Damage',
        //         'priority_level' => 'Mid',
        //         'deadline' => Carbon::create(2023, 10, 27),
        //         'status' => 'In Progress',
        //         'assigned_to' => 2
        //     ],
            
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Academic Building V',
        //         'unit' => 'MIS',
        //         'request' => 'Damage Printer',
        //         'description' => 'Printer Damage Damage Damage Printer Printer',
        //         'priority_level' => 'High',
        //         'deadline' => Carbon::create(2023, 12, 22),
        //         'status' => 'Open',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Cashier Office',
        //         'unit' => 'MIT',
        //         'request' => 'aircon',
        //         'description' => 'Damage Damage Printer Printer',
        //         'priority_level' => 'Mid',
        //         'deadline' => Carbon::create(2023, 12, 22),
        //         'status' => 'In Progress',
        //         'assigned_to' => 2
        //     ],
        //     [
        //         'user_id' => 3,
        //         'service_location' => 'Office',
        //         'unit' => 'Repair',
        //         'request' => 'ID issues',
        //         'description' => 'Need for Repair',
        //         'priority_level' => 'High',
        //         'deadline' => Carbon::create(2023, 02, 22),
        //         'status' => 'Closed',
        //         'assigned_to' => 2
        //     ],
        // ];

        // foreach ($tickets as $ticketData) {
        //     Ticket::create($ticketData);
        // }














    }
}
