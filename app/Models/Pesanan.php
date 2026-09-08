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
        'customer_id',
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
}