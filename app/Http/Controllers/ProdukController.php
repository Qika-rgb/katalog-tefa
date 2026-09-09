<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // Form tambah produk untuk Admin Jurusan
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin-jurusan.produk.create', compact('kategoris'));
    }

    // Proses simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('produk', 'public');
        }

        // Simpan produk & otomatis isi kolom jurusan sesuai admin yang login
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi'   => $request->deskripsi,
            'harga'       => $request->harga,
            'kategori_id' => $request->kategori_id,
            'jurusan'     => Auth::user()->jurusan, // OTOMATIS TERIKAT JURUSAN ADMIN
            'foto'        => $fotoPath,
        ]);

        return redirect()->route('admin-jurusan.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Halaman Katalog untuk Customer
    public function indexKatalog()
    {
        $produks = Produk::with('kategori')->get();
        return view('katalog.index', compact('produks'));
    }
}