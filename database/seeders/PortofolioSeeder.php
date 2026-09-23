<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('portofolios')->insert([
            // 0 = RPL
            [
                'judul'       => 'Aplikasi Presensi RFID & Face Recognition',
                'pembuat'     => 'Tim Siswa RPL SMKN 4',
                'deskripsi'   => 'Sistem pencatatan absensi digital terintegrasi perangkat keras RFID dan deteksi wajah.',
                'gambar'      => 'portofolio/rpl_demo.png',
                'kategori_id' => 0,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // 1 = Animasi
            [
                'judul'       => 'Film Pendek Animasi 2D "Petualangan Si Kancil"',
                'pembuat'     => 'Studio Animasi TEFA',
                'deskripsi'   => 'Karya animasi 2D frame-by-frame dengan karakter dan alur cerita edukasi.',
                'gambar'      => 'portofolio/animasi_demo.png',
                'kategori_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // 2 = TKJ
            [
                'judul'       => 'Pemasangan Infrastruktur Hotspot & Firewall Mikrotik',
                'pembuat'     => 'Divisi Jaringan TKJ',
                'deskripsi'   => 'Instalasi jaringan nirkabel terdistribusi dengan sistem voucher captive portal.',
                'gambar'      => 'portofolio/tkj_demo.png',
                'kategori_id' => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // 3 = PSPT
            [
                'judul'       => 'Dokumenter Kebudayaan Pulau Penyengat',
                'pembuat'     => 'Kru Broadcaster PSPT',
                'deskripsi'   => 'Produksi video dokumenter berstandar siaran televisi dengan liputan multicam.',
                'gambar'      => 'portofolio/pspt_demo.png',
                'kategori_id' => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // 4 = DKV
            [
                'judul'       => 'Branding Visual & Desain Kemasan UMKM',
                'pembuat'     => 'Siswa DKV Angkatan 2026',
                'deskripsi'   => 'Perancangan identitas visual, logo, dan packaging ramah lingkungan untuk produk lokal.',
                'gambar'      => 'portofolio/dkv_demo.png',
                'kategori_id' => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // 5 = Gim
            [
                'judul'       => 'Game Edukasi 3D Petualangan Nusantara',
                'pembuat'     => 'Game Developer TEFA Gim',
                'deskripsi'   => 'Game interaktif platformer 3D bertema sejarah dan budaya lokal.',
                'gambar'      => 'portofolio/gim_demo.png',
                'kategori_id' => 5,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}