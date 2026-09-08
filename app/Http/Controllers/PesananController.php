<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
   public function status()
{
    // Mengambil pesanan beserta relasi detailPesanans & produk, diurutkan dari yang terbaru di-update
    $pesanans = Pesanan::with(['detailPesanans.produk', 'produk'])
        ->latest('updated_at')
        ->get();

    return view('status', compact('pesanans'));
}
}