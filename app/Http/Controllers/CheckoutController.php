<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Keranjang;
use App\Models\Produk;

class CheckoutController extends Controller
{
    // Menyimpan data "beli langsung" ke session, lalu arahkan ke halaman checkout
    public function langsung(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah'    => 'required|numeric|min:1',
        ]);

        session(['buy_now' => [
            'produk_id' => $request->produk_id,
            'jumlah'    => $request->jumlah,
        ]]);

        return redirect('/checkout');
    }

    // Menampilkan halaman checkout
    public function index()
    {
        if (session()->has('buy_now')) {
            // Mode "Beli Langsung": bikin data pesanan sementara, tanpa sentuh tabel keranjang
            $buyNow = session('buy_now');
            $produk = Produk::findOrFail($buyNow['produk_id']);

            $keranjangs = collect([
                (object) [
                    'produk_id' => $produk->id,
                    'produk'    => $produk,
                    'jumlah'    => $buyNow['jumlah'],
                ]
            ]);
        } else {
            // Mode normal: ambil dari keranjang seperti biasa
            $keranjangs = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        }

        return view('checkout', compact('keranjangs'));
    }

    // Menyimpan pesanan
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'alamat'  => 'required|string',
        ]);

        $user_id = Auth::id();

        if (session()->has('buy_now')) {
            $buyNow = session('buy_now');
            $produk = Produk::findOrFail($buyNow['produk_id']);

            $keranjangs = collect([
                (object) [
                    'produk_id' => $produk->id,
                    'produk'    => $produk,
                    'jumlah'    => $buyNow['jumlah'],
                ]
            ]);
        } else {
            $keranjangs = Keranjang::with('produk')->where('user_id', $user_id)->get();

            if ($keranjangs->isEmpty()) {
                return redirect('/keranjang')->with('error', 'Keranjang masih kosong.');
            }
        }

        DB::transaction(function () use ($request, $keranjangs, $user_id) {
            $produkPertama = $keranjangs->first();
            $totalJumlah = $keranjangs->sum('jumlah');

            $pesanan = Pesanan::create([
<<<<<<< HEAD
                'produk_id'  => $produkPertama->produk_id,
                'user_id'    => $user_id,
                'no_telepon' => $request->telepon,
                'jumlah'     => $totalJumlah,
                'status'     => 'Pending',
=======
                'produk_id'   => $produkPertama->produk_id,
                'user_id'     => $user_id, 
                'no_telepon'  => $request->telepon,
                'jumlah'      => $totalJumlah,
                'status'      => 'Pending', 
>>>>>>> 6a27fb97cc0824b2664bb04bef876ceb65e44c33
            ]);

            foreach ($keranjangs as $item) {
                // Bersihkan harga dari string/rentang teks agar aman disimpan ke kolom database bertipe angka
                $hargaMentah = $item->produk->harga;
                
                if (str_contains($hargaMentah, '-')) {
                    // Jika berupa rentang (contoh: 150.000 - 300.000), ambil angka awalnya atau jadikan 0
                    $parts = explode('-', $hargaMentah);
                    $hargaBersih = (float) str_replace(['.', ','], '', trim($parts[0]));
                } else {
                    $hargaBersih = is_numeric(str_replace(['.', ','], '', $hargaMentah)) 
                        ? (float) str_replace(['.', ','], '', $hargaMentah) 
                        : 0;
                }

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id'  => $item->produk_id,
                    'jumlah'     => $item->jumlah,
<<<<<<< HEAD
                    'harga'      => $item->produk->harga,
=======
                    'harga'      => $hargaBersih, // Menggunakan harga yang sudah bersih dari string/rentang
>>>>>>> 6a27fb97cc0824b2664bb04bef876ceb65e44c33
                ]);
            }

            // Kosongkan keranjang HANYA kalau ini bukan mode "Beli Langsung"
            if (!session()->has('buy_now')) {
                Keranjang::where('user_id', $user_id)->delete();
            }
        });

        session()->forget('buy_now');

        return redirect('/status')->with('success', 'Pesanan berhasil dibuat dan menunggu verifikasi Admin!');
    }
}