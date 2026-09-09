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
    return view('admin-products', compact('kategoris'));
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

    // Halaman Katalog untuk Customer (Sudah Dilengkapi Logika Filter & Search)
    public function indexKatalog()
    {
        // 1. Tangkap apa yang diklik/diketik user di URL
        $kategori = request('kategori');
        $cari = request('cari');

        // 2. Siapkan wadah query database (sudah termasuk relasi kategori)
        $query = Produk::with('kategori');

        // 3. Logika Filter Kategori Jurusan
        if ($kategori !== null && $kategori !== 'all') {
            // Saring produk berdasarkan ID kategori (0=RPL, 1=Animasi, dll)
            $query->where('kategori_id', $kategori);
        }

        // 4. Logika Filter Pencarian (Search Bar)
        if ($cari) {
            // Cari produk yang namanya mirip dengan ketikan user
            $query->where('nama_produk', 'LIKE', '%' . $cari . '%');
        }

        // 5. Ambil data yang sudah disaring
        $produks = $query->get();

        return view('katalog', compact('produks'));
    }
}
