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

        // Jika keranjang kosong
        if (empty($keranjang)) {
            return redirect('/keranjang')
                ->with('error', 'Keranjang masih kosong.');
        }

        DB::transaction(function () use ($request, $keranjang) {

            // Ambil item pertama dari keranjang terlepas dari key-nya
            $firstKey = array_key_first($keranjang);
            $produkPertama = $keranjang[$firstKey];

            // Hitung total jumlah barang
            $totalJumlah = collect($keranjang)->sum(function ($item) {
                return $item['jumlah'] ?? 1;
            });

            // Simpan pesanan utama dengan status 'Pending' untuk verifikasi Admin
            $pesanan = Pesanan::create([
                'produk_id'  => $produkPertama['id'] ?? $produkPertama['produk_id'] ?? $firstKey,
                'customer_id' => null,
                'no_telepon'  => $request->telepon,
                'jumlah'      => $totalJumlah,
               'status' => 'Tahap Pembuatan',
            ]);

            // Simpan setiap produk ke detail pesanan
            foreach ($keranjang as $produkId => $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id'  => $item['id'] ?? $item['produk_id'] ?? $produkId,
                    'jumlah'     => $item['jumlah'] ?? 1,
                    'harga'      => $item['harga'] ?? 0,
                ]);
            }
        });

        // Kosongkan keranjang
        session()->forget('keranjang');

        // Kembali ke halaman status
        return redirect('/status')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}