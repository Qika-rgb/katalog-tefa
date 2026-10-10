<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Form & Daftar produk untuk Admin Jurusan
    public function create()

{
    $user = Auth::user();
    $jurusan = strtoupper(trim($user->jurusan ?? ''));

    $jurusanMap = [
        'RPL'     => 0,
        'ANIMASI' => 1,
        'TKJ'     => 2,
        'PSPT'    => 3,
        'DKV'     => 4,
        'GIM'     => 5,
    ];

    $kategoriId = $jurusanMap[$jurusan] ?? null;

    if ($kategoriId === null) {
        abort(403, 'Jurusan akun admin belum terdaftar.');
    }

    $produks = Produk::where('kategori_id', $kategoriId)
        ->latest()
        ->get();

    $kategoris = Kategori::where('id', $kategoriId)->get();

    return view('admin-products', compact('produks', 'kategoris'));
}
    // Proses simpan produk baru
   
public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'deskripsi'   => 'required|string',
        'harga'       => 'required|numeric',
        'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $user = Auth::user();
    $jurusan = strtoupper(trim($user->jurusan ?? ''));

    $jurusanMap = [
        'RPL'     => 0,
        'ANIMASI' => 1,
        'TKJ'     => 2,
        'PSPT'    => 3,
        'DKV'     => 4,
        'GIM'     => 5,
    ];

    $kategoriId = $jurusanMap[$jurusan] ?? null;

    if ($kategoriId === null) {
        return redirect()->back()
            ->withErrors(['jurusan' => 'Jurusan akun admin belum terdaftar.']);
    }

    $kategori = Kategori::find($kategoriId);

    if (!$kategori) {
        return redirect()->back()
            ->withErrors(['kategori' => 'Kategori jurusan tidak ditemukan di database.']);
    }

    $fotoPath = null;

    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('produk', 'public');
    }

    Produk::create([
        'nama_produk' => $request->nama_produk,
        'deskripsi'   => $request->deskripsi,
        'harga'       => $request->harga,
        'kategori_id' => $kategoriId,
        'jurusan'     => $jurusan,
        'foto'        => $fotoPath,
    ]);

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|numeric',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        $data = [
            'nama_produk' => $request->nama_produk,
            'deskripsi'   => $request->deskripsi,
            'harga'       => $request->harga,
        ];

        // Jika ada file gambar baru yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage jika bukan foto default
            if ($produk->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->foto)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->foto);
            }
            
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->back()->with('success', 'Data produk berhasil diperbarui!');
    }

    // Halaman Katalog untuk Customer
    public function indexKatalog()
    {
        $kategori = request('kategori');
        $cari = request('cari');

        $query = Produk::with('kategori');

        if ($kategori !== null && $kategori !== 'all') {
            $query->where('kategori_id', $kategori);
        }

        if ($cari) {
            $query->where('nama_produk', 'LIKE', '%' . $cari . '%');
        }

        $produks = $query->latest()->paginate(8)->appends(request()->query());

        return view('katalog', compact('produks'));
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus file gambar jika tersimpan di folder storage
        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}