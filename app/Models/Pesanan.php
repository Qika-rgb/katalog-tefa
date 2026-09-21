<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'produk_id',
        'user_id', // <-- PERBAIKAN: Diubah dari customer_id menjadi user_id
        'no_telepon',
        'jumlah',
        'status',
        'estimasi_selesai',
    ];

    // Relasi ke model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // Relasi ke model User (menggunakan user_id)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // <-- PERBAIKAN: Sesuaikan foreign key-nya
    }

    // Relasi ke detail pesanan (daftar produk dalam 1 pesanan)
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }
}