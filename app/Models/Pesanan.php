<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
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
=======
        'produk_id',
        'customer_id',
        'no_telepon',
        'jumlah',
        'status',
        'estimasi_selesai',
    ];
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
}