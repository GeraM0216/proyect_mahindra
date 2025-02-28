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
        DB::table('users')->insert([ 
            'name' => Str::random(10), // it will create a  random word with 10 digits 
            'email' => Str::random(10).'@gmail.com', // random email with 10 digits 
            'password' => Hash::make('password'), // coded ‘password’ word
          ]);
    }
}
