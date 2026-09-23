<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    private $jurusanMap = [
        'RPL'     => 0,
        'Animasi' => 1,
        'TKJ'     => 2,
        'PSPT'    => 3,
        'DKV'     => 4,
        'Gim'     => 5,
    ];

    // ==========================================
    // 1. TAMPILAN PUBLIK (UNTUK PENGUNJUNG)
    // ==========================================
    public function index(Request $request)
    {
        $kategoriAktif = $request->query('kategori', 'all');

        $portofolios = Portofolio::when($kategoriAktif !== 'all' && $kategoriAktif !== null, function ($query) use ($kategoriAktif) {
            return $query->where('kategori_id', $kategoriAktif);
        })
        ->latest()
        ->get();

        $daftarJurusan = [
            ['id' => '0', 'nama' => 'RPL', 'logo' => 'logo_rpl.jpeg'],
            ['id' => '4', 'nama' => 'DKV', 'logo' => 'logo_dkv.jpeg'],
            ['id' => '2', 'nama' => 'TKJ', 'logo' => 'logo_tkj.jpeg'],
            ['id' => '1', 'nama' => 'Animasi', 'logo' => 'logo_animasi.jpeg'],
            ['id' => '3', 'nama' => 'PSPT', 'logo' => 'logo_pspt.jpeg'],
            ['id' => '5', 'nama' => 'Gim', 'logo' => 'logo_gim.jpeg'],
        ];

        return view('portofolio', compact('portofolios', 'kategoriAktif', 'daftarJurusan'));
    }

    // ==========================================
    // 2. TAMPILAN ADMIN JURUSAN
    // ==========================================
    public function adminIndex()
    {
        $user = Auth::user();

        // Normalisasi role agar tidak sensitif huruf besar/kecil & spasi/underscore
        $userRole = strtolower(trim(str_replace('_', ' ', $user->role ?? '')));

        if ($userRole !== 'admin jurusan') {
            abort(403, 'Akses khusus Admin Jurusan. Role akun Anda yang terdeteksi: "' . ($user->role ?? 'belum login') . '"');
        }

        $userJurusan = strtoupper(trim($user->jurusan ?? ''));
        $kategoriId = $this->jurusanMap[$userJurusan] ?? null;

        // Ambil portofolio jurusan ini saja
        $portofolios = Portofolio::where('kategori_id', $kategoriId)->latest()->get();

        return view('admin-portofolio', compact('portofolios', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $userRole = strtolower(trim(str_replace('_', ' ', $user->role ?? '')));

        if ($userRole !== 'admin jurusan') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'judul'     => 'required|string|max:255',
            'pembuat'   => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $userJurusan = strtoupper(trim($user->jurusan ?? ''));
        $kategoriId = $this->jurusanMap[$userJurusan] ?? 0;
        $path = $request->file('gambar')->store('portofolio', 'public');

        Portofolio::create([
            'judul'       => $request->judul,
            'kategori_id' => $kategoriId,
            'pembuat'     => $request->pembuat,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $path,
        ]);

        return redirect()->back()->with('success', 'Portofolio ' . $user->jurusan . ' berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $portofolio = Portofolio::findOrFail($id);

        $userRole = strtolower(trim(str_replace('_', ' ', $user->role ?? '')));
        $userJurusan = strtoupper(trim($user->jurusan ?? ''));
        $kategoriId = $this->jurusanMap[$userJurusan] ?? null;

        if ($userRole !== 'admin jurusan' || (int)$portofolio->kategori_id !== (int)$kategoriId) {
            abort(403, 'Anda tidak memiliki hak akses mengubah portofolio jurusan lain.');
        }

        $request->validate([
            'judul'     => 'required|string|max:255',
            'pembuat'   => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'judul'     => $request->judul,
            'pembuat'   => $request->pembuat,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($portofolio->gambar && Storage::disk('public')->exists($portofolio->gambar)) {
                Storage::disk('public')->delete($portofolio->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('portofolio', 'public');
        }

        $portofolio->update($data);

        return redirect()->back()->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $portofolio = Portofolio::findOrFail($id);

        $userRole = strtolower(trim(str_replace('_', ' ', $user->role ?? '')));
        $userJurusan = strtoupper(trim($user->jurusan ?? ''));
        $kategoriId = $this->jurusanMap[$userJurusan] ?? null;

        if ($userRole !== 'admin jurusan' || (int)$portofolio->kategori_id !== (int)$kategoriId) {
            abort(403, 'Anda tidak berhak menghapus karya ini.');
        }

        if ($portofolio->gambar && Storage::disk('public')->exists($portofolio->gambar)) {
            Storage::disk('public')->delete($portofolio->gambar);
        }

        $portofolio->delete();

        return redirect()->back()->with('success', 'Portofolio berhasil dihapus!');
    }
}