<?php

namespace App\Http\Controllers;

use App\Models\produk;

class KatalogController extends Controller
{
    public function index()
    {
        $produks = produk::all();

        return view('katalog', compact('produks'));
    }

    public function detail($id)
{
    $produk = produk::findOrFail($id);

    return view('pemesanan', compact('produk'));
}
}

