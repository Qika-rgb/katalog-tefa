<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Siapkan kerangka query
        $query = produk::query();

        // 2. Filter berdasarkan kategori_id (Angka)
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori_id', $request->kategori); 
        }

        // 3. Filter berdasarkan nama_produk (Pencarian Teks)
        if ($request->filled('cari')) {
            $query->where('nama_produk', 'like', '%' . $request->cari . '%');
        }

        // 4. Eksekusi pencarian
        $produks = $query->get();

        return view('katalog', compact('produks'));
    }

    public function detail($id)
    {
        $produk = produk::findOrFail($id);

        return view('pemesanan', compact('produk'));
    }
}