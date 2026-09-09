<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Pusat
        User::create([
            'name' => 'Admin Pusat',
            'email' => 'adminpusat@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_pusat',
        ]);

        // 2. Akun Admin Jurusan
        User::create([
            'name' => 'Admin RPL',
            'email' => 'adminrpl@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_jurusan',
            'jurusan' => 'RPL',
        ]);

        // 3. Akun Customer
        User::create([
            'name' => 'Customer Biasa',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);
    }
}