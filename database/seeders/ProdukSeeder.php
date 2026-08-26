<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'deskripsi' => 'Jasa pembuatan website untuk kebutuhan sekolah, bisnis, dan organisasi.',
                'harga' => 500000,
                'foto' => 'produk_rpl2.png',
            ],
            [
                'nama_produk' => 'Pembuatan Gim',
                'deskripsi' => 'Jasa pembuatan gim sesuai dengan konsep dan kebutuhan pengguna.',
                'harga' => 750000,
                'foto' => 'produk_gim1.png',
            ],
            [
                'nama_produk' => 'Aset 3D',
                'deskripsi' => 'Pembuatan aset 3D untuk kebutuhan desain, animasi, dan gim.',
                'harga' => 150000,
                'foto' => 'produk_gim2.png',
            ],
            [
                'nama_produk' => 'Paperbag',
                'deskripsi' => 'Pembuatan paperbag dengan desain sesuai kebutuhan.',
                'harga' => 10000,
                'foto' => 'produk_dkv2.png',
            ],
            [
                'nama_produk' => 'Jasa Design',
                'deskripsi' => 'Jasa desain untuk poster, media promosi, dan kebutuhan visual lainnya.',
                'harga' => 50000,
                'foto' => 'produk_dkv3.png',
            ],
            [
                'nama_produk' => 'Name Tag',
                'deskripsi' => 'Pembuatan name tag untuk kegiatan sekolah, acara, dan organisasi.',
                'harga' => 15000,
                'foto' => 'produk_dkv1.png',
            ],
            [
                'nama_produk' => 'Gantungan Kunci',
                'deskripsi' => 'Pembuatan gantungan kunci sebagai merchandise dan cendera mata.',
                'harga' => 10000,
                'foto' => 'produk_dkv4.png',
            ],
            [
                'nama_produk' => 'Sewa Studio Podcast',
                'deskripsi' => 'Jasa penyewaan studio podcast untuk kebutuhan rekaman.',
                'harga' => 100000,
                'foto' => 'produk_pspt.png',
            ],
            [
                'nama_produk' => 'Jasa Pemasangan WiFi',
                'deskripsi' => 'Jasa pemasangan jaringan WiFi untuk kebutuhan rumah, sekolah, dan usaha.',
                'harga' => 150000,
                'foto' => 'produk_tkj.png',
            ],
            [
                'nama_produk' => 'Jasa Pembuatan Aplikasi',
                'deskripsi' => 'Jasa pembuatan aplikasi sesuai kebutuhan dan konsep yang diberikan.',
                'harga' => 1000000,
                'foto' => 'produk_rpl3.png',
            ],
            [
                'nama_produk' => 'Jasa Web Service',
                'deskripsi' => 'Jasa pembuatan dan pengelolaan layanan web sesuai kebutuhan.',
                'harga' => 500000,
                'foto' => 'produk_rpl1.png',
            ],
            [
                'nama_produk' => 'Jasa Pembuatan Animasi',
                'deskripsi' => 'Jasa pembuatan animasi 2D dan 3D sesuai kebutuhan.',
                'harga' => 500000,
                'foto' => 'produk_animasi.png',
            ],
        ]);
    }
}