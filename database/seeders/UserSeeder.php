<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'mzahranrabbani@gmail.com'],
            [
                'name' => 'Muhammad Zahran',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@gereja.com'],
            [
                'name' => 'Admin Gereja',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
