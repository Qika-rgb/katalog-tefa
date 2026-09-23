<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // =========================
            // 1. ADMIN PUSAT (SUPERADMIN)
            // =========================
            [
                'name'              => 'Admin Pusat TEFA',
                'email'             => 'adminpusat@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin_pusat',
                'jurusan'           => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],

            // =======================================================
            // 2. ADMIN JURUSAN (Semua memakai domain @gmail.com)
            // =======================================================
            [
                'name'              => 'Admin TEFA RPL',
                'email'             => 'adminrpl@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin_jurusan',
                'jurusan'           => 'RPL',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Admin TEFA Animasi',
                'email'             => 'adminanimasi@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin_jurusan',
                'jurusan'           => 'Animasi',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Admin TEFA TKJ',
                'email'             => 'admintkj@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin_jurusan',
                'jurusan'           => 'TKJ',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Admin TEFA PSPT',
                'email'             => 'adminpspt@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin_jurusan',
                'jurusan'           => 'PSPT',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Admin TEFA DKV',
                'email'             => 'admindkv@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin_jurusan',
                'jurusan'           => 'DKV',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Admin TEFA Gim',
                'email'             => 'admingim@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin_jurusan',
                'jurusan'           => 'Gim',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],

            // =========================
            // 3. AKUN CUSTOMER / PEMBELI
            // =========================
            [
                'name'              => 'Pembeli Demo',
                'email'             => 'customer@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'customer',
                'jurusan'           => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}