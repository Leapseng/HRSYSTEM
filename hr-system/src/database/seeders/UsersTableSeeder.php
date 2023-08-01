<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '', // Fill this with the admin's phone number if available
            'address' => 'admin',
            'department' => 'admin',
            'job' => 'admin',
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '', // Fill this with the user's phone number if available
            'address' => 'Some Address 1',
            'department' => 1,
            'job' => 1,
            'role' => 'Staff',
        ]);
    
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '', // Fill this with the user's phone number if available
            'address' => 'Some Address 2',
            'department' => 1,
            'job' => 2,
            'role' => 'Staff',
        ]);
    
        User::create([
            'name' => 'Michael Johnson',
            'email' => 'michael@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '', // Fill this with the user's phone number if available
            'address' => 'Some Address 3',
            'department' => 2,
            'job' => 3,
            'role' => 'Staff',
        ]);
    
        User::create([
            'name' => 'Emily Brown',
            'email' => 'emily@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '', // Fill this with the user's phone number if available
            'address' => 'Some Address 4',
            'department' => 2,
            'job' => 4,
            'role' => 'Staff',
        ]);
    }
}
