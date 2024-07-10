<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User seeding
        $users = [
            [
                'name' => 'China Bea',
                'email' => 'chibea@my.cspc.edu.ph ',
                'role' => 1, // Director
                'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjUyzMg5jnHLaIdqVOMbOfKy5sg3jjS-0QBMjHXk14sVzI10lSZcGBwjtKQj1k0fSphccVgWSuhjQiJZKUauEH1erHlTV1egHnFzXInY_x44JRpyRIcoCTkHwbVLAzUzapUs-_QDlfwPuK9yFLAalRQkmTRGSbe1YPxixEU5pvK8wbgRc92cNgV727ERWMi33Wglb_7ZlF78xYQ2dcui4XMpmU5-2mH9NmeZ5blLPgovGEyoUQfFHMsM9cj6OIy7030e5RRyKkfOoqB6-ogVj9wI_9C8oZJarYQYUurz_P7gQokUhVMI0QtnkeUaKbzrFsltN8V-ukM7_2Ji75-T_H2z5RVTGn9KGYzWxIRso9yxuhTXVjkYNDRndVCP8SapkCIynkdD-LHcmiaWsUGOb8Cn35FKlXAkFV00l_J8EME4LB2vGdENNCP2Bje6P0ijO9JnKgpr7HiON4w9rK5b8hsLqmjXqdA9y7EsBrzhGQvIoTB8IwsN0mZPQM5fg33WeaSebgAoqejm-iNTYVV8_i171jSm0tdu5e-5uMlmguJKFVMOOsqtTmuqvImSdVRGnEaXrluab2M4FX2Q2b0TburziOpuDhTm6fIbjz3J3aMSkAofR4fzr8NZphKDW30xNO_mzy50o2bC0tYopiD_tL1rj-IRfqIO-xY_TwrsPt3ngC3T6599U5_896dPFrffAlEtogH7t9HaQdHxKgH3NiPhJC0DWj5LBdUehJGcF9sMRFz6W2LnO6oXAneItDFQYL1TiBs8uFcChd4PFKRakFDUyLwgG8Lq_ewVh8kAu-hkZ_qamKYO5DdZWfMTCZYacDDZWP6sY9pOR_C_Yw94Kn06KfgWcxn-lAAFueSO5JVZG20o4bl9hrxg46Eq9vg5QAhFTZ1SENMKkLhplgBNHS3V_ruGNDdZkHtvZdXr9VCAl6J2io_H9dvkOOs9LN7P8sMiioZ8u4uKBPYOLhG0BNam4Q=s96-c',
                'is_approved' => true,
                'phone_number' => '09628950257',
                'job_position' => 'Director',
                'expertise' => ['Developer', 'Software Programmer'],
                
            ],
            [
                'name' => 'Mark Louis Odavar',
                'email' => 'mlodavar@my.cspc.edu.ph',
                'role' => 2, // ICTRAM Head
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocIGM3-G1PBRp1kRe61ZRM4xR67hq-bUW4O3BkjhHdyDisp6bOM=s96-c',
                'is_approved' => true,
                'phone_number' => '09246794618',
                'job_position' => 'ICTRAM Head',
                'expertise' => ['Developer', 'Software Programmer'],
            ],
            [
                'name' => 'Jessemri Tabayag',
                'email' => 'jestabayag@my.cspc.edu.ph',
                'role' => 3, // NICMU Head
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKjGmqvq6Rrri0tkpCM3vx2q7lZc30Wm2OUs1BFdeq-_-8jLF-n=s96-c',
                'is_approved' => true,
                'phone_number' => '09248769368',
                'job_position' => 'NICMU Head',
                'expertise' => ['Networking'],
            ],
            [
                'name' => 'John Carlo Dacara',
                'email' => 'johdacara@my.cspc.edu.ph',
                'role' => 4, // MIS Head
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKSDUrjoiSNypUvGZdT8iNqHHnd7A5ATUycaAP6GbH6pH9GDg=s96-c',
                'is_approved' => true,
                'phone_number' => '09248769368',
                'job_position' => 'MIS Head',
                'expertise' => ['Technician'],
                
            ],
            [
                'name' => 'JESSICA MATAYA',
                'email' => 'jesmataya@my.cspc.edu.ph',
                'role' => 5, // Staff
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKUB0nARYGxuJCevZG8KLnVwpmTDrJsZfFZa7ZdFCLaiJ49pWfI=s96-c',
                'is_approved' => true,
                'phone_number' => '09386390756',
                'job_position' => 'Staff',
                'expertise' => ['Networking'],
            ],
            [
                'name' => 'Louie Molina',
                'email' => 'loumolina@my.cspc.edu.ph',
                'role' => 6, // Student
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocLIEi3iP9WuXqHV_W1U__h7MFcAFPmwnDCOSmJjhHErFqxQ2g=s96-c',
                'is_approved' => true,
                'phone_number' => '0952845284',
                'job_position' => 'Student',
                'expertise' => ['Networking'],
                
            ],
            [
                'name' => 'Jeo Penones',
                'email' => 'jeopenones@my.cspc.edu.ph',
                'role' => 7, // ICTRAM Staff
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocIU9mJPOaL8tS8teFt-r3jexryvQPLTWA2LGerg-RmMmwyfKOc=s96-c',
                'is_approved' => true,
                'phone_number' => '09705536944',
                'job_position' => 'ICTRAM Staff',
                'expertise' => ['Networking'],
                
            ],
            [
                'name' => 'Eva Marie Villareal',
                'email' => 'evavillareal@my.cspc.edu.ph',
                'role' => 8, // NICMU Staff
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocKPKDznnRYZvM2EUUDJSSEm6sccsesvVmNGVRYYDKQIdewxKIRm=s96-c',
                'is_approved' => true,
                'phone_number' => '09705536944',
                'job_position' => 'NICMU Staff',
                'expertise' => ['Networking'],
                
            ],
            [
                'name' => 'Jeramae Tabayag',
                'email' => 'jertabayag@my.cspc.edu.ph',
                'role' => 9, // MIS Staff
                'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocIU9mJPOaL8tS8teFt-r3jexryvQPLTWA2LGerg-RmMmwyfKOc=s96-c',
                'is_approved' => true,
                'phone_number' => '09705536944',
                'job_position' => 'MIS Staff',
                'expertise' => ['Networking'],
                
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
       
    }
}
