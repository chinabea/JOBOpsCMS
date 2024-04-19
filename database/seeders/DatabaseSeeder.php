<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Ticket;

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
                'user_id' => '1',
                'first_name' => 'China',
                'last_name' => 'Bea',
                'email' => 'chibea@my.cspc.edu.ph',
                'role' => 1,
            ],
            [
                'user_id' => '2',
                'first_name' => 'Jessica',
                'last_name' => 'Mataya',
                'email' => 'jesmataya@my.cspc.edu.ph',
                'role' => 2,
            ],
            [
                'user_id' => '3',
                'first_name' => 'John Carlo',
                'last_name' => 'Dacara',
                'email' => 'johdacara@my.cspc.edu.ph',
                'role' => 2,
            ],
            [
                'user_id' => '4',
                'first_name' => 'Mark Louis',
                'last_name' => 'Odavar',
                'email' => 'mlodavar@my.cspc.edu.ph',
                'role' => 1,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        
        $tickets = [
            [
                'unit' => 'MIS',
                'request' => 'Damage Printer',
                'description' => 'Printer Damage Damage Damage Printer Printer',
                'user_id' => 2,
            ],
            [
                'unit' => 'MIT',
                'request' => 'aircon',
                'description' => 'Damage Damage Printer Printer',
                'user_id' => 2,
            ],
        ];

        foreach ($tickets as $ticketData) {
            Ticket::create($ticketData);
        }














    }
}
