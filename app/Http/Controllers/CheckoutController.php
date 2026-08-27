<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        $keranjang = session()->get('keranjang', []);

        return view('checkout', compact('keranjang'));
    }

    // Menyimpan pesanan
    public function store(Request $request)
    {
        // Validasi data pembeli
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        // Ambil keranjang
        $keranjang = session()->get('keranjang', []);

        // Kalau keranjang kosong
        if (empty($keranjang)) {
            return redirect('/keranjang')
                ->with('error', 'Keranjang masih kosong.');
        }

        // Hitung total harga
        $total = collect($keranjang)->sum(function ($item) {
            return $item['harga'] * $item['jumlah'];
        });

        // Simpan pesanan dan detailnya
        DB::transaction(function () use ($request, $keranjang, $total) {

            // Simpan data utama pesanan
            $pesanan = Pesanan::create([
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'total' => $total,
                'status' => 'Menunggu',
            ]);

            // Simpan setiap produk yang dipesan
            foreach ($keranjang as $item) {

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $item['id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                ]);
            }
        });

        // Kosongkan keranjang setelah pesanan berhasil
        session()->forget('keranjang');

        // Kembali ke halaman status
        return redirect('/status')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}