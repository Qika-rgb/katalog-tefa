<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

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
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'nama_pemesan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $jumlah = $request->jumlah;
        $totalHarga = $produk->harga * $jumlah;

        Pesanan::create([
            'user_id' => Auth::id(),
            'produk_id' => $produk->id,
            'nama_pemesan' => $request->nama_pemesan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah' => $jumlah,
            'total_harga' => $totalHarga,
            'status' => 'Pending',
        ]);

        return redirect()->route('pesanan.status')->with('success', 'Pesanan langsung berhasil dibuat!');
    }
}