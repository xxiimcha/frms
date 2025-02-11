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
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active'
            ]
        );

        User::updateOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Franchise Manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('password123'),
                'role' => 'franchise_manager',
                'status' => 'active'
            ]
        );

        User::updateOrCreate(
            ['email' => 'accounting@example.com'],
            [
                'name' => 'Accounting User',
                'email' => 'accounting@example.com',
                'password' => Hash::make('password123'),
                'role' => 'accounting',
                'status' => 'inactive'
            ]
        );
    }
}
