<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'total',
        'status',
    ];

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}