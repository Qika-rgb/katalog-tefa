<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'id' => 0,
                'nama_kategori' => 'RPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 1,
                'nama_kategori' => 'Animasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_kategori' => 'TKJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_kategori' => 'PSPT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama_kategori' => 'DKV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_kategori' => 'Gim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}