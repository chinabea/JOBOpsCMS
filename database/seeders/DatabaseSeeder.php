<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
                'role' => 1,
                'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjUyzMg5jnHLaIdqVOMbOfKy5sg3jjS-0QBMjHXk14sVzI10lSZcGBwjtKQj1k0fSphccVgWSuhjQiJZKUauEH1erHlTV1egHnFzXInY_x44JRpyRIcoCTkHwbVLAzUzapUs-_QDlfwPuK9yFLAalRQkmTRGSbe1YPxixEU5pvK8wbgRc92cNgV727ERWMi33Wglb_7ZlF78xYQ2dcui4XMpmU5-2mH9NmeZ5blLPgovGEyoUQfFHMsM9cj6OIy7030e5RRyKkfOoqB6-ogVj9wI_9C8oZJarYQYUurz_P7gQokUhVMI0QtnkeUaKbzrFsltN8V-ukM7_2Ji75-T_H2z5RVTGn9KGYzWxIRso9yxuhTXVjkYNDRndVCP8SapkCIynkdD-LHcmiaWsUGOb8Cn35FKlXAkFV00l_J8EME4LB2vGdENNCP2Bje6P0ijO9JnKgpr7HiON4w9rK5b8hsLqmjXqdA9y7EsBrzhGQvIoTB8IwsN0mZPQM5fg33WeaSebgAoqejm-iNTYVV8_i171jSm0tdu5e-5uMlmguJKFVMOOsqtTmuqvImSdVRGnEaXrluab2M4FX2Q2b0TburziOpuDhTm6fIbjz3J3aMSkAofR4fzr8NZphKDW30xNO_mzy50o2bC0tYopiD_tL1rj-IRfqIO-xY_TwrsPt3ngC3T6599U5_896dPFrffAlEtogH7t9HaQdHxKgH3NiPhJC0DWj5LBdUehJGcF9sMRFz6W2LnO6oXAneItDFQYL1TiBs8uFcChd4PFKRakFDUyLwgG8Lq_ewVh8kAu-hkZ_qamKYO5DdZWfMTCZYacDDZWP6sY9pOR_C_Yw94Kn06KfgWcxn-lAAFueSO5JVZG20o4bl9hrxg46Eq9vg5QAhFTZ1SENMKkLhplgBNHS3V_ruGNDdZkHtvZdXr9VCAl6J2io_H9dvkOOs9LN7P8sMiioZ8u4uKBPYOLhG0BNam4Q=s96-c',
                'is_approved' => true,
                'phone_number' => '09628950257',
                'job_position' => 'Software Developer',
                'expertise' => ['Developer', 'Software Programmer'],
                
            ],
            [
                'name' => 'Mark Louis Odavar',
                'email' => 'mlodavar@my.cspc.edu.ph',
                'role' => 2,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocIGM3-G1PBRp1kRe61ZRM4xR67hq-bUW4O3BkjhHdyDisp6bOM=s96-c',
                'is_approved' => true,
                'phone_number' => '09246794618',
                'job_position' => 'Software Developer',
                'expertise' => ['Developer', 'Software Programmer'],
            ],
            [
                'name' => 'JESSICA MATAYA',
                'email' => 'jesmataya@my.cspc.edu.ph',
                'role' => 3,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKUB0nARYGxuJCevZG8KLnVwpmTDrJsZfFZa7ZdFCLaiJ49pWfI=s96-c',
                'is_approved' => true,
                'phone_number' => '09386390756',
                'job_position' => 'Admin Aide 1',
                'expertise' => ['Networking'],
            ],
            [
                'name' => 'John Carlo Dacara',
                'email' => 'johdacara@my.cspc.edu.ph',
                'role' => 4,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKSDUrjoiSNypUvGZdT8iNqHHnd7A5ATUycaAP6GbH6pH9GDg=s96-c',
                'is_approved' => true,
                'phone_number' => '09248769368',
                'job_position' => 'Admin Aide',
                'expertise' => ['Technician'],
                
            ],
            [
                'name' => 'Jessemri Tabayag',
                'email' => 'jestabayag@my.cspc.edu.ph',
                'role' => 3,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKjGmqvq6Rrri0tkpCM3vx2q7lZc30Wm2OUs1BFdeq-_-8jLF-n=s96-c',
                'is_approved' => true,
                'phone_number' => '09248769368',
                'job_position' => 'Admin Aide 2',
                'expertise' => ['Networking'],
            ],
            [
                'name' => 'Louie Molina',
                'email' => 'loumolina@my.cspc.edu.ph',
                'role' => null,
                'is_approved' => false,
                'phone_number' => null,
                'job_position' => 'Admin Aide',
                'expertise' => null,
                
            ],
            [
                'name' => 'Rica Theresa Adante',
                'email' => 'ricadante@my.cspc.edu.ph',
                'role' => null,
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocLDuPOe6NaSoJcu5ATbEJsn3ptMJlkAgp3awFZQCY8cqCl4bA=s96-c',
                'is_approved' => false,
                'phone_number' => null,
                'job_position' => 'Admin Aide',
                'expertise' => null,
                
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
        
        // Ticket seeding
        $faker = Faker::create();
        $approvedUsers = User::where('is_approved', true)
                      ->whereIn('role', [1, 2, 3]) 
                      ->pluck('id')
                      ->toArray();
                      
        $serviceLocationOptions = [
            'Academic Building V', 'Cashier Office', 'Registrar Office', 
        ];
        $unitOptions = ['MICT', 'MIS', 'Repair', 'Network'];
        $requestOptions = [
            'Unable to Access Student Database', 'Email Setup on New Staff Computers', 
        ];
        $priorityLevels = ['High', 'Mid', 'Low'];
        $statusOptions = ['Open', 'In Progress', 'Closed'];

        for ($i = 0; $i < 70; $i++) {            
            $randomTimestamp = $faker->dateTimeBetween('-1 years', 'now');
            $ticket = Ticket::create([
                'user_id'          => $faker->randomElement($approvedUsers), 
                'service_location' => $faker->randomElement($serviceLocationOptions),
                'unit'             => $faker->randomElement($unitOptions),
                'request'          => $faker->randomElement($requestOptions),
                'priority_level'   => $faker->randomElement($priorityLevels),
                'deadline'         => $faker->date(),
                'description'      => $faker->sentence(),
                'file_path'        => $faker->randomElement([$faker->imageUrl(), null]),
                'status'           => $faker->randomElement($statusOptions),
                'created_at' => $randomTimestamp,
                'updated_at' => $randomTimestamp,
                // 'created_at'       => $faker->dateTimeThisYear(),
                // 'updated_at'       => $faker->dateTimeThisYear()
            ]);

            // Assign approved users to tickets using the pivot table
            // Can assign multiple users or none
            $numberOfUsersToAssign = $faker->numberBetween(0, 3); // Number of users to assign
            $assignedUsers = $faker->randomElements($approvedUsers, $numberOfUsersToAssign); // Correctly picking random elements

            foreach ($assignedUsers as $userId) {
                $ticket->users()->attach($userId); // Assuming Ticket model has users() relation defined
            }

        }
    }
}
