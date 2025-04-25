<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = 
        [
            // [
            //     'name'=> 'Admin',
            //     'email'=> 'Admin@gmail.com',
            //     'role'=>'admin',
            //     'password'=>bcrypt('!t@r3k1nD$')
            // ],
            [
                'name' => 'userss',
                'email' => 'userss@gmail.com',
                'role' => 'user',
                'password' => bcrypt('12345678')
            ],
        ];
        
        foreach($userData as $key => $val) {
            User::create($val);
        }

    }
}
