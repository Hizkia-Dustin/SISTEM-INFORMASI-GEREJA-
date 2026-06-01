<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Muhammad Zahran',
            'email' => 'mzahranrabbani@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        \App\Models\User::create([
            'name' => 'Admin Gereja',
            'email' => 'admin@gereja.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        ]);
    }
}
