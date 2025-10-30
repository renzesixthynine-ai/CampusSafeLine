<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create officer user
        User::create([
            'name' => 'Safety Officer',
            'email' => 'officer@example.com',
            'password' => Hash::make('officer123'),
            'role' => 'officer',
            'is_active' => true,
        ]);

        // Create sample reporter user
        User::create([
            'name' => 'John Doe',
            'email' => 'reporter@example.com',
            'password' => Hash::make('reporter123'),
            'role' => 'reporter',
            'is_active' => true,
        ]);
    }
}