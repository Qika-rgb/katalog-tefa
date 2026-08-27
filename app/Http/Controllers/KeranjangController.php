<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function tambah(Request $request, $id)
    {
        $produk = produk::findOrFail($id);

        $jumlah = (int) $request->input('jumlah', 1);

        if ($jumlah < 1) {
            $jumlah = 1;
        }

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] += $jumlah;
        } else {
            $keranjang[$id] = [
                'id' => $produk->id,
                'nama_produk' => $produk->nama_produk,
                'harga' => $produk->harga,
                'foto' => $produk->foto,
                'jumlah' => $jumlah,
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect('/keranjang');
    }

    public function index()
    {
        $keranjang = session()->get('keranjang', []);

        return view('keranjang', compact('keranjang'));
    }
}