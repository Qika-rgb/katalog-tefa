<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjangs';

    protected $fillable = [
        'user_id',
        'produk_id',
        'jumlah',
    ];

    // Relasi ke Model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // Relasi ke Model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}