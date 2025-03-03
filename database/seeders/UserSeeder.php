<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
  
        $data = [
            "name"=> "Ben",
            "email"=> "Ben10@gmail.com",
            "password"=> Hash::make("password")
        ];
        DB::table("users")->insert($data);
    }
}
