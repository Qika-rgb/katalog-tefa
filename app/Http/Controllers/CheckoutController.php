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
                'produk_id'  => $produkPertama->produk_id,
                'user_id'    => $user_id,
                'no_telepon' => $request->telepon,
                'jumlah'     => $totalJumlah,
                'status'     => 'Pending',
            ]);

            foreach ($keranjangs as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id'  => $item->produk_id,
                    'jumlah'     => $item->jumlah,
                    'harga'      => $item->produk->harga,
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