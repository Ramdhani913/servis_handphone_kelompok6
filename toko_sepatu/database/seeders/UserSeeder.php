<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'adress' => 'Jl. Admin No. 1',
            'email' => 'admin@example.com',
            'phonenumber' => '08123456789',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => 'active',
        ]);

        User::create([
            'name' => 'Teknisi Satu',
            'adress' => 'Jl. Teknisi No. 2',
            'email' => 'tech@example.com',
            'phonenumber' => '08129876543',
            'password' => Hash::make('password123'),
            'role' => 'technician',
            'is_active' => 'active',
        ]);

        User::create([
            'name' => 'Pelanggan Awal',
            'adress' => 'Jl. Customer No. 3',
            'email' => 'customer@example.com',
            'phonenumber' => '081255544433',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'is_active' => 'active',
        ]);
    }
}
