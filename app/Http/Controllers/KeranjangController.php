<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        // Mengambil keranjang berdasarkan user yang sedang login
        $keranjangs = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        return view('keranjang', compact('keranjangs'));
    }

    public function tambah(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
        ]);

        // Simpan langsung ke database tabel keranjangs
        Keranjang::create([
            'user_id'   => Auth::id(),
            'produk_id' => $id,
            'jumlah'    => $request->jumlah,
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambah ke keranjang!');
    }
}