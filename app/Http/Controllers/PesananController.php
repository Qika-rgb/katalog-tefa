<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'produk_id'  => 'required|exists:produks,id',
            'jumlah'     => 'required|numeric|min:1',
            'no_telepon' => 'required|string',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $totalHarga = $produk->harga * $request->jumlah;

        Pesanan::create([
            'user_id'     => Auth::id(),
            'produk_id'   => $produk->id,
            'jumlah'      => $request->jumlah,
            'total_harga' => $totalHarga,
            'no_telepon'  => $request->no_telepon,
            'status'      => 'Pending',
        ]);

        // Hapus item dari keranjang setelah pesanan dibuat (jika berasal dari keranjang)
        Keranjang::where('user_id', Auth::id())->where('produk_id', $request->produk_id)->delete();

        return redirect()->route('pesanan.status')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function status()
    {
        // Menyesuaikan dengan relasi produk langsung di tabel pesanans
        $pesanans = Pesanan::with('produk')
            ->where('user_id', Auth::id())
            ->latest('updated_at')
            ->get();

        return view('status', compact('pesanans'));
    }

    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Tahap Pembuatan,Pengemasan,Siap Diambil,Sudah Diambil,Ditolak',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}