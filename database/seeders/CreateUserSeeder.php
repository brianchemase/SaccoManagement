<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
               'name'=>'User',
               'email'=>'user@sacco.com',
               'phone'=>'0720200200',
               'role'=> 0,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Editor',
               'email'=>'editor@sacco.com',
               'phone'=>'0721202020',
               'role'=> 1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Admin',
               'email'=>'admin@sacco.com',
               'phone'=>'0713113113',
               'role'=> 2,
               'password'=> bcrypt('123456'),
            ],
            
        ];
    
        foreach ($users as $key => $user) 
        {
            User::create($user);
        }
    }
}
