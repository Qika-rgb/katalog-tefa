<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

<<<<<<< HEAD
=======
    protected $table = 'produks';

>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'foto',
        'kategori_id',
    ];
<<<<<<< HEAD
}
=======
}
>>>>>>> a894e0da890fef75c47b6927a37dd077cff026f1
