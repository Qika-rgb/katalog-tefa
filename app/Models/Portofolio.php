<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'pembuat',
        'gambar',
        'kategori_id',
    ];

    // Relasi: 1 Portofolio memiliki banyak gambar slider
    public function images()
    {
        return $this->hasMany(PortofolioImage::class);
    }

    // Relasi: 1 Portofolio memiliki banyak anggota tim
    public function teams()
    {
        return $this->hasMany(PortofolioTeam::class);
    }
}