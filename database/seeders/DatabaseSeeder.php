<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ticket;
use App\Models\IctramJobType;
use App\Models\IctramEquipment;
use App\Models\IctramProblem;
use App\Models\NicmuJobType;
use App\Models\NicmuEquipment;
use App\Models\NicmuProblem;
use App\Models\MisRequestType;
use App\Models\MisJobType;
use App\Models\MisAsname;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UsersTableSeeder::class,
            NicmuJobTypesTableSeeder::class,
            NicmuEquipmentsTableSeeder::class,
            NicmuProblemsTableSeeder::class,
            MisRequestTypesTableSeeder::class,
            MisAsnamesTableSeeder::class,
            MisRequestTypesTableSeeder::class,
            MisAsnamesTableSeeder::class,
            MisJobTypesTableSeeder::class,
            IctramJobTypesTableSeeder::class,
            IctramEquipmentsTableSeeder::class,
            IctramProblemsTableSeeder::class,
            UnitTableSeeder::class,
            BuildingNumbersSeeder::class,
            OfficeNamesSeeder::class,
            TicketsTableSeeder::class,
            TicketUserSeeder::class,
        ]);
        
        // $tickets = [
        //     [
        //         'user_id' => 1,
        //         'building_number' => 'Acad Building 1',
        //         'office_name' => 'Dean',
        //         'unit' => 'ICT Repair and Maintence',
        //         'unit_options' => '',
        //         'phone_number' => '09628950257',
        //         'job_position' => 'Software Developer',
        //         'expertise' => ['Developer', 'Software Programmer'],
                
        //     ],
        // ];

        // foreach ($tickets as $ticketData) {
        //     Ticket::create($ticketData);
        // }
        
        // Ticket seeding
        // $faker = Faker::create();
        // $approvedUsers = User::where('is_approved', true)
        //               ->whereIn('role', [1, 2, 3]) 
        //               ->pluck('id')
        //               ->toArray();
                      
        // $serviceLocationOptions = [
        //     'Academic Building V', 'Cashier Office', 'Registrar Office', 
        // ];
        // $unitOptions = ['MICT', 'MIS', 'Repair', 'Network'];
        // $requestOptions = [
        //     'Unable to Access Student Database', 'Email Setup on New Staff Computers', 
        // ];
        // $priorityLevels = ['High', 'Mid', 'Low'];
        // $statusOptions = ['Open', 'In Progress', 'Closed'];

        // for ($i = 0; $i < 70; $i++) {            
        //     $randomTimestamp = $faker->dateTimeBetween('-1 years', 'now');
        //     $ticket = Ticket::create([
        //         'user_id'          => $faker->randomElement($approvedUsers), 
        //         'service_location' => $faker->randomElement($serviceLocationOptions),
        //         'unit'             => $faker->randomElement($unitOptions),
        //         'request'          => $faker->randomElement($requestOptions),
        //         'priority_level'   => $faker->randomElement($priorityLevels),
        //         'deadline'         => $faker->date(),
        //         'description'      => $faker->sentence(),
        //         'file_path'        => $faker->randomElement([$faker->imageUrl(), null]),
        //         'status'           => $faker->randomElement($statusOptions),
        //         'created_at' => $randomTimestamp,
        //         'updated_at' => $randomTimestamp,
        //         // 'created_at'       => $faker->dateTimeThisYear(),
        //         // 'updated_at'       => $faker->dateTimeThisYear()
        //     ]);

        //     // Assign approved users to tickets using the pivot table
        //     // Can assign multiple users or none
        //     $numberOfUsersToAssign = $faker->numberBetween(0, 3); // Number of users to assign
        //     $assignedUsers = $faker->randomElements($approvedUsers, $numberOfUsersToAssign); // Correctly picking random elements

        //     foreach ($assignedUsers as $userId) {
        //         $ticket->users()->attach($userId); // Assuming Ticket model has users() relation defined
        //     }

        // }
    }
}
