<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortofolioTeam extends Model
{
    use HasFactory;

    protected $fillable = ['portofolio_id', 'nama', 'peran', 'foto'];

    public function portofolio()
    {
        return $this->belongsTo(Portofolio::class);
    }
}