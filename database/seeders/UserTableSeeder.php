<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table("users")->insert([

            //Admin
            [
                "name" =>'Admin',
                "username" => "admin",
                "email" => "Admin@gmail.com",
                "password" =>Hash::make('12345678'),
                "role" => 'admin',
                "status" =>"active"


            ],
             //Agent
             [
                "name" =>'Agent',
                "username" => "aget",
                "email" => "Agent@gmail.com",
                "password" =>Hash::make('12345678'),
                "role" => 'agent',
                "status" =>"active"


             ],
              //user
            [
                "name" =>'User',
                "username" => "user",
                "email" => "user@gmail.com",
                "password" =>Hash::make('12345678'),
                "role" => 'user',
                "status" =>"active"


            ]
        ]);
    }
}
