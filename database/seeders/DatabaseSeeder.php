<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'charish',
                'fullname' => 'Charish Trisuard',
                'email' => 'charis12876.com',
                'telephone' => '1234567890',
                'address' => 'Jl. SDN CIPADU 1',
                'password' => Hash::make('123'), // Hash the password
                'role' => 'parent',
            ],
        ]);
    }
}
