<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'nama_produk' => 'Website',
                'deskripsi' => 'Jasa pembuatan website.',
                'harga' => 500000,
                'foto' => 'website.jpg',
                'kategori_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Pembuatan Gim',
                'deskripsi' => 'Jasa pembuatan gim.',
                'harga' => 750000,
                'foto' => 'pembuatan-gim.jpg',
                'kategori_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Aset 3D',
                'deskripsi' => 'Pembuatan aset 3D.',
                'harga' => 300000,
                'foto' => 'aset-3d.jpg',
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Paperbag',
                'deskripsi' => 'Pembuatan paperbag.',
                'harga' => 10000,
                'foto' => 'paperbag.jpg',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Jasa Design',
                'deskripsi' => 'Jasa desain berbagai kebutuhan.',
                'harga' => 100000,
                'foto' => 'jasa-design.jpg',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Name Tag',
                'deskripsi' => 'Pembuatan name tag.',
                'harga' => 5000,
                'foto' => 'name-tag.jpg',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Gantungan Kunci',
                'deskripsi' => 'Pembuatan gantungan kunci.',
                'harga' => 10000,
                'foto' => 'gantungan-kunci.jpg',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Sewa Studio Podcast',
                'deskripsi' => 'Jasa sewa studio podcast.',
                'harga' => 150000,
                'foto' => 'studio-podcast.jpg',
                'kategori_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Jasa Pemasangan WiFi',
                'deskripsi' => 'Jasa pemasangan jaringan WiFi.',
                'harga' => 200000,
                'foto' => 'pemasangan-wifi.jpg',
                'kategori_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Jasa Pembuatan Aplikasi',
                'deskripsi' => 'Jasa pembuatan aplikasi.',
                'harga' => 1000000,
                'foto' => 'pembuatan-aplikasi.jpg',
                'kategori_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Jasa Web Service',
                'deskripsi' => 'Jasa web service.',
                'harga' => 500000,
                'foto' => 'web-service.jpg',
                'kategori_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Jasa Edit',
                'deskripsi' => 'Jasa editing foto atau video.',
                'harga' => 100000,
                'foto' => 'jasa-edit.jpg',
                'kategori_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Jasa Pembuatan Animasi',
                'deskripsi' => 'Jasa pembuatan animasi.',
                'harga' => 500000,
                'foto' => 'pembuatan-animasi.jpg',
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}