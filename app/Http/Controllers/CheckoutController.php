<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Checkout langsung dari tombol pemesanan satuan
        if ($request->has('produk_id')) {
            $produk = Produk::findOrFail($request->produk_id);

            $qty = (int) $request->input('qty', 1);

            $items = [
                (object) [
                    'produk' => $produk,
                    'jumlah' => $qty,
                    'subtotal' => $produk->harga * $qty,
                ]
            ];

            $totalHarga = $produk->harga * $qty;

            return view('checkout', compact(
                'items',
                'totalHarga',
                'produk',
                'qty'
            ));
        }

        // Checkout dari keranjang
        $items = Keranjang::with('produk')
            ->where('user_id', $user->id)
            ->get();

        if ($items->isEmpty()) {
            return redirect()
                ->route('keranjang.index')
                ->with('error', 'Keranjang belanjaan kamu masih kosong.');
        }

        $totalHarga = $items->sum(function ($item) {
            return $item->produk->harga * $item->jumlah;
        });

        return view('checkout', compact(
            'items',
            'totalHarga'
        ));
    }


    public function store(Request $request)
    {
        // Validasi data dari form checkout
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20',
            'alamat'       => 'required|string',
        ]);

        $user = Auth::user();

        // ==========================================
        // CHECKOUT LANGSUNG 1 PRODUK
        // ==========================================
        if ($request->filled('produk_id')) {

            $produk = Produk::findOrFail($request->produk_id);

            $qty = (int) $request->input('qty', 1);

            Pesanan::create([
                'user_id'     => $user->id,
                'produk_id'   => $produk->id,
                'no_telepon'  => $request->no_hp,
                'jumlah'      => $qty,
                'total_harga' => $produk->harga * $qty,
                'status'      => 'Pending',
            ]);

            return redirect()
                ->route('pesanan.status')
                ->with('success', 'Pesanan berhasil dibuat!');
        }


        // ==========================================
        // CHECKOUT DARI KERANJANG
        // ==========================================
        $items = Keranjang::with('produk')
            ->where('user_id', $user->id)
            ->get();

        if ($items->isEmpty()) {
            return redirect()
                ->route('keranjang.index')
                ->with('error', 'Keranjang kosong.');
        }

        foreach ($items as $item) {

            Pesanan::create([
                'user_id'     => $user->id,
                'produk_id'   => $item->produk_id,
                'no_telepon'  => $request->no_hp,
                'jumlah'      => $item->jumlah,
                'total_harga' => $item->produk->harga * $item->jumlah,
                'status'      => 'Pending',
            ]);
        }

        // Hapus isi keranjang setelah berhasil checkout
        Keranjang::where('user_id', $user->id)->delete();

        return redirect()
            ->route('pesanan.status')
            ->with('success', 'Semua pesanan dari keranjang berhasil dibuat!');
    }


    public function langsung(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah'    => 'required|integer|min:1',
        ]);

        return redirect()->route('checkout.index', [
            'produk_id' => $request->produk_id,
            'qty'       => (int) $request->jumlah,
        ]);
    }
}