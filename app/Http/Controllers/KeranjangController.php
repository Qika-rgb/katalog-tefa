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

    Keranjang::create([
        'user_id'   => Auth::id(),
        'produk_id' => $id,
        'jumlah'    => $request->jumlah,
    ]);

    // Kalau tombol BUY yang diklik, langsung ke checkout
    if ($request->query('checkout')) {
        return redirect('/checkout');
    }

    return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambah ke keranjang!');
}

    // FUNGSI BARU UNTUK MENGHAPUS PRODUK DARI KERANJANG
    public function hapus($id)
    {
        // Cari data keranjang berdasarkan ID
        $keranjang = Keranjang::findOrFail($id);
        
        // Keamanan ekstra: Pastikan hanya pemilik keranjang yang bisa menghapusnya
        if ($keranjang->user_id == Auth::id()) {
            $keranjang->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Gagal menghapus produk. Akses ditolak.');
    }
}