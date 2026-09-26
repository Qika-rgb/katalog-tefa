<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Cek apakah ini checkout langsung dari tombol "Order Now" / produk satuan
        if ($request->has('produk_id')) {
            $produk = Produk::findOrFail($request->produk_id);
            $qty = $request->input('qty', 1);
            $items = [
                (object)[
                    'produk' => $produk,
                    'jumlah' => $qty,
                    'subtotal' => $produk->harga * $qty
                ]
            ];
            $totalHarga = $produk->harga * $qty;
            return view('checkout', compact('items', 'totalHarga', 'produk', 'qty'));
        }

        // Jika checkout dari keranjang belanja biasa
        $items = Keranjang::with('produk')->where('user_id', $user->id)->get();
        
        if ($items->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang belanjaan kamu masih kosong.');
        }

        $totalHarga = $items->sum(function($item) {
            return $item->produk->harga * $item->jumlah;
        });

        return view('checkout', compact('items', 'totalHarga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        $user = Auth::user();

        // Proses jika checkout langsung (Single Product)
        if ($request->has('produk_id') && $request->produk_id) {
            $produk = Produk::findOrFail($request->produk_id);
            $qty = $request->input('qty', 1);

            Pesanan::create([
                'user_id' => $user->id,
                'produk_id' => $produk->id,
                'nama_pemesan' => $request->nama_pemesan,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'metode_pembayaran' => $request->metode_pembayaran,
                'jumlah' => $qty,
                'total_harga' => $produk->harga * $qty,
                'status' => 'Pending',
            ]);

            return redirect()->route('pesanan.status')->with('success', 'Pesanan berhasil dibuat!');
        }

        // Proses jika checkout dari keranjang
        $items = Keranjang::with('produk')->where('user_id', $user->id)->get();

        if ($items->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong.');
        }

        foreach ($items as $item) {
            Pesanan::create([
                'user_id' => $user->id,
                'produk_id' => $item->produk_id,
                'nama_pemesan' => $request->nama_pemesan,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'metode_pembayaran' => $request->metode_pembayaran,
                'jumlah' => $item->jumlah,
                'total_harga' => $item->produk->harga * $item->jumlah,
                'status' => 'Pending',
            ]);
        }

        // Kosongkan keranjang setelah checkout berhasil
        Keranjang::where('user_id', $user->id)->delete();

        return redirect()->route('pesanan.status')->with('success', 'Semua pesanan dari keranjang berhasil dibuat!');
    }

    public function langsung(Request $request)
    {
        $request->validate([
            'produk_id' => 'nullable|exists:produks,id',
            'jumlah' => 'nullable|integer|min:1',
            'telepon' => 'nullable|string|max:20',
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
                'no_telepon' => $request->telepon ?? '',
                'jumlah'     => $totalJumlah,
                'status'     => 'Pending',
            ]);

            foreach ($keranjangs as $item) {
                $hargaMentah = (string) $item->produk->harga;
                
                if (str_contains($hargaMentah, '-')) {
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
                    'harga'      => $hargaBersih,
                ]);
            }

            if (!session()->has('buy_now')) {
                Keranjang::where('user_id', $user_id)->delete();
            }
        });

        session()->forget('buy_now');

        return redirect()->route('pesanan.status')->with('success', 'Pesanan berhasil dibuat dan menunggu verifikasi Admin!');
    }
}