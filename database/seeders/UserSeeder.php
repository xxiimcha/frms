<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default users
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Franchise Manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('password123'),
                'role' => 'franchise_manager',
            ],
            [
                'name' => 'Accounting User',
                'email' => 'accounting@example.com',
                'password' => Hash::make('password123'),
                'role' => 'accounting',
            ],
        ];

        // Insert users into the database
        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // Prevent duplicate entries
                $user
            );
        }
    }
}
