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
<<<<<<< HEAD
                'foto' => 'produk_rpl2.png',
                'kategori_id' => 0,
=======
                'foto' => 'website.jpg',
                'kategori_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Pembuatan Gim',
                'deskripsi' => 'Jasa pembuatan gim.',
                'harga' => 750000,
<<<<<<< HEAD
                'foto' => 'produk_gim1.png',
                'kategori_id' => 5,
=======
                'foto' => 'pembuatan-gim.jpg',
                'kategori_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Aset 3D',
<<<<<<< HEAD
                'deskripsi' => 'Pembuatan aset 3D untuk kebutuhan desain, animasi, dan gim.',
                'harga' => 150000,
                'foto' => 'produk_gim2.png',
                'kategori_id' => 5,
=======
                'deskripsi' => 'Pembuatan aset 3D.',
                'harga' => 300000,
                'foto' => 'aset-3d.jpg',
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Paperbag',
                'deskripsi' => 'Pembuatan paperbag.',
                'harga' => 10000,
<<<<<<< HEAD
                'foto' => 'produk_dkv2.png',
                'kategori_id' => 4,
=======
                'foto' => 'paperbag.jpg',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Jasa Design',
<<<<<<< HEAD
                'deskripsi' => 'Jasa desain untuk poster, media promosi, dan kebutuhan visual lainnya.',
                'harga' => 50000,
                'foto' => 'produk_dkv3.png',
                'kategori_id' => 4,
=======
                'deskripsi' => 'Jasa desain berbagai kebutuhan.',
                'harga' => 100000,
                'foto' => 'jasa-design.jpg',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Name Tag',
<<<<<<< HEAD
                'deskripsi' => 'Pembuatan name tag untuk kegiatan sekolah, acara, dan organisasi.',
                'harga' => 15000,
                'foto' => 'produk_dkv1.png',
                'kategori_id' => 4,
=======
                'deskripsi' => 'Pembuatan name tag.',
                'harga' => 5000,
                'foto' => 'name-tag.jpg',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Gantungan Kunci',
                'deskripsi' => 'Pembuatan gantungan kunci.',
                'harga' => 10000,
<<<<<<< HEAD
                'foto' => 'produk_dkv4.png',
                'kategori_id' => 4,
=======
                'foto' => 'gantungan-kunci.jpg',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Sewa Studio Podcast',
<<<<<<< HEAD
                'deskripsi' => 'Jasa penyewaan studio podcast untuk kebutuhan rekaman.',
                'harga' => 100000,
                'foto' => 'produk_pspt.png',
                'kategori_id' => 3,
=======
                'deskripsi' => 'Jasa sewa studio podcast.',
                'harga' => 150000,
                'foto' => 'studio-podcast.jpg',
                'kategori_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Jasa Pemasangan WiFi',
<<<<<<< HEAD
                'deskripsi' => 'Jasa pemasangan jaringan WiFi untuk kebutuhan rumah, sekolah, dan usaha.',
                'harga' => 150000,
                'foto' => 'produk_tkj.png',
                'kategori_id' => 2,
=======
                'deskripsi' => 'Jasa pemasangan jaringan WiFi.',
                'harga' => 200000,
                'foto' => 'pemasangan-wifi.jpg',
                'kategori_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Jasa Pembuatan Aplikasi',
                'deskripsi' => 'Jasa pembuatan aplikasi.',
                'harga' => 1000000,
<<<<<<< HEAD
                'foto' => 'produk_rpl3.png',
                'kategori_id' => 0,
=======
                'foto' => 'pembuatan-aplikasi.jpg',
                'kategori_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],

            [
                'nama_produk' => 'Jasa Web Service',
                'deskripsi' => 'Jasa web service.',
                'harga' => 500000,
<<<<<<< HEAD
                'foto' => 'produk_rpl1.png',
                'kategori_id' => 0,
=======
                'foto' => 'web-service.jpg',
                'kategori_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
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
<<<<<<< HEAD
                'foto' => 'produk_animasi.png',
                'kategori_id' => 1,
=======
                'foto' => 'pembuatan-animasi.jpg',
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
            ],
        ]);
    }
}