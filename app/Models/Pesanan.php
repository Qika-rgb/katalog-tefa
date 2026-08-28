<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Menggunakan struktur tabel terbaru dari tim backend
    protected $fillable = [
        'produk_id',
        'customer_id',
        'no_telepon',
        'jumlah',
        'status',
    ];

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}