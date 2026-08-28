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
                'foto' => 'produk_rpl2.png',
                'kategori_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Pembuatan Gim',
                'deskripsi' => 'Jasa pembuatan gim.',
                'harga' => 750000,
                'foto' => 'produk_gim1.png',
                'kategori_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Aset 3D',
                'deskripsi' => 'Pembuatan aset 3D untuk kebutuhan desain, animasi, dan gim.',
                'harga' => 150000,
                'foto' => 'produk_gim2.png',
                'kategori_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Paperbag',
                'deskripsi' => 'Pembuatan paperbag.',
                'harga' => 10000,
                'foto' => 'produk_dkv2.png',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Jasa Design',
                'deskripsi' => 'Jasa desain untuk poster, media promosi, dan kebutuhan visual lainnya.',
                'harga' => 50000,
                'foto' => 'produk_dkv3.png',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Name Tag',
                'deskripsi' => 'Pembuatan name tag untuk kegiatan sekolah, acara, dan organisasi.',
                'harga' => 15000,
                'foto' => 'produk_dkv1.png',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Gantungan Kunci',
                'deskripsi' => 'Pembuatan gantungan kunci.',
                'harga' => 10000,
                'foto' => 'produk_dkv4.png',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Sewa Studio Podcast',
                'deskripsi' => 'Jasa penyewaan studio podcast untuk kebutuhan rekaman.',
                'harga' => 100000,
                'foto' => 'produk_pspt.png',
                'kategori_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Jasa Pemasangan WiFi',
                'deskripsi' => 'Jasa pemasangan jaringan WiFi untuk kebutuhan rumah, sekolah, dan usaha.',
                'harga' => 150000,
                'foto' => 'produk_tkj.png',
                'kategori_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Jasa Pembuatan Aplikasi',
                'deskripsi' => 'Jasa pembuatan aplikasi.',
                'harga' => 1000000,
                'foto' => 'produk_rpl3.png',
                'kategori_id' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Jasa Web Service',
                'deskripsi' => 'Jasa web service.',
                'harga' => 500000,
                'foto' => 'produk_rpl1.png',
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
                'foto' => 'produk_animasi.png',
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}