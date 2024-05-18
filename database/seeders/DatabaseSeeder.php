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
        // User seeding
        $users = [
            [
                'name' => 'China Bea',
                'email' => 'chibea@my.cspc.edu.ph ',
                // Director
                'role' => 1,
                'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjUyzMg5jnHLaIdqVOMbOfKy5sg3jjS-0QBMjHXk14sVzI10lSZcGBwjtKQj1k0fSphccVgWSuhjQiJZKUauEH1erHlTV1egHnFzXInY_x44JRpyRIcoCTkHwbVLAzUzapUs-_QDlfwPuK9yFLAalRQkmTRGSbe1YPxixEU5pvK8wbgRc92cNgV727ERWMi33Wglb_7ZlF78xYQ2dcui4XMpmU5-2mH9NmeZ5blLPgovGEyoUQfFHMsM9cj6OIy7030e5RRyKkfOoqB6-ogVj9wI_9C8oZJarYQYUurz_P7gQokUhVMI0QtnkeUaKbzrFsltN8V-ukM7_2Ji75-T_H2z5RVTGn9KGYzWxIRso9yxuhTXVjkYNDRndVCP8SapkCIynkdD-LHcmiaWsUGOb8Cn35FKlXAkFV00l_J8EME4LB2vGdENNCP2Bje6P0ijO9JnKgpr7HiON4w9rK5b8hsLqmjXqdA9y7EsBrzhGQvIoTB8IwsN0mZPQM5fg33WeaSebgAoqejm-iNTYVV8_i171jSm0tdu5e-5uMlmguJKFVMOOsqtTmuqvImSdVRGnEaXrluab2M4FX2Q2b0TburziOpuDhTm6fIbjz3J3aMSkAofR4fzr8NZphKDW30xNO_mzy50o2bC0tYopiD_tL1rj-IRfqIO-xY_TwrsPt3ngC3T6599U5_896dPFrffAlEtogH7t9HaQdHxKgH3NiPhJC0DWj5LBdUehJGcF9sMRFz6W2LnO6oXAneItDFQYL1TiBs8uFcChd4PFKRakFDUyLwgG8Lq_ewVh8kAu-hkZ_qamKYO5DdZWfMTCZYacDDZWP6sY9pOR_C_Yw94Kn06KfgWcxn-lAAFueSO5JVZG20o4bl9hrxg46Eq9vg5QAhFTZ1SENMKkLhplgBNHS3V_ruGNDdZkHtvZdXr9VCAl6J2io_H9dvkOOs9LN7P8sMiioZ8u4uKBPYOLhG0BNam4Q=s96-c',
                'is_approved' => true,
                'phone_number' => '09628950257',
                'job_position' => 'Director',
                'expertise' => ['Developer', 'Software Programmer'],
                
            ],
            [
                'name' => 'Mark Louis Odavar',
                'email' => 'mlodavar@my.cspc.edu.ph',
                // ICTRAM Head
                'role' => 2,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocIGM3-G1PBRp1kRe61ZRM4xR67hq-bUW4O3BkjhHdyDisp6bOM=s96-c',
                'is_approved' => true,
                'phone_number' => '09246794618',
                'job_position' => 'ICTRAM Head',
                'expertise' => ['Developer', 'Software Programmer'],
            ],
            [
                'name' => 'Jessemri Tabayag',
                'email' => 'jestabayag@my.cspc.edu.ph',
                // NICMU Head
                'role' => 3,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKjGmqvq6Rrri0tkpCM3vx2q7lZc30Wm2OUs1BFdeq-_-8jLF-n=s96-c',
                'is_approved' => true,
                'phone_number' => '09248769368',
                'job_position' => 'NICMU Head',
                'expertise' => ['Networking'],
            ],
            [
                'name' => 'John Carlo Dacara',
                'email' => 'johdacara@my.cspc.edu.ph',
                // MIS Head
                'role' => 4,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKSDUrjoiSNypUvGZdT8iNqHHnd7A5ATUycaAP6GbH6pH9GDg=s96-c',
                'is_approved' => true,
                'phone_number' => '09248769368',
                'job_position' => 'MIS Head',
                'expertise' => ['Technician'],
                
            ],
            [
                'name' => 'JESSICA MATAYA',
                'email' => 'jesmataya@my.cspc.edu.ph',
                // Staff
                'role' => 5,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKUB0nARYGxuJCevZG8KLnVwpmTDrJsZfFZa7ZdFCLaiJ49pWfI=s96-c',
                'is_approved' => true,
                'phone_number' => '09386390756',
                'job_position' => 'Staff',
                'expertise' => ['Networking'],
            ],
            [
                'name' => 'Louie Molina',
                'email' => 'loumolina@my.cspc.edu.ph',
                // Student
                'role' => 6,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocLIEi3iP9WuXqHV_W1U__h7MFcAFPmwnDCOSmJjhHErFqxQ2g=s96-c',
                'is_approved' => false,
                'phone_number' => null,
                'job_position' => 'Student',
                'expertise' => null,
                
            ],
            [
                'name' => 'Rica Theresa Adante',
                'email' => 'ricadante@my.cspc.edu.ph',
                // MICT Staff
                'role' => 7,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocLDuPOe6NaSoJcu5ATbEJsn3ptMJlkAgp3awFZQCY8cqCl4bA=s96-c',
                'is_approved' => false,
                'phone_number' => null,
                'job_position' => 'MICT Staff',
                'expertise' => null,
                
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
       

        $this->call([
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
            TicketsTableSeeder::class,
            // Add other seeders here
        ]);

        DB::table('ictram_equipments')->insert([
            ['equipment_name' => 'All in One PC'],
            ['equipment_name' => 'Printer'],
            // Add more equipments as needed
        ]);

        // Seed ICTRAM Problems
        DB::table('ictram_problems')->insert([
            ['problem_description' => 'No dial tone'],
            ['problem_description' => 'Paper Jams'],
            // Add more problems as needed
        ]);
        
        // Seed MIS Request Types
        DB::table('mis_request_types')->insert([
            ['requestType_name' => 'Software Installation'],
            ['requestType_name' => 'Hardware Repair'],
            // Add more request types as needed
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
