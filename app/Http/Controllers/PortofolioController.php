<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Models\PortofolioImage;
use App\Models\PortofolioTeam;
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

        // Normalisasi role
        $userRole = strtolower(trim(str_replace('_', ' ', $user->role ?? '')));

        if ($userRole !== 'admin jurusan') {
            abort(403, 'Akses khusus Admin Jurusan.');
        }

        $userJurusan = strtoupper(trim($user->jurusan ?? ''));
        $kategoriId = $this->jurusanMap[$userJurusan] ?? null;

        // Ambil portofolio beserta relasi images dan teams
        $portofolios = Portofolio::with(['images', 'teams'])
            ->where('kategori_id', $kategoriId)
            ->latest()
            ->get();

        return view('admin-portofolio', compact('portofolios', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $userRole = strtolower(trim(str_replace('_', ' ', $user->role ?? '')));

        if ($userRole !== 'admin jurusan') {
            abort(403, 'Akses ditolak.');
        }

        // Validasi input
        $request->validate([
            'judul'             => 'required|string|max:255',
            'pembuat'           => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Thumbnail utama
            'slider_images.*'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Gambar slider (multiple)
            'team_nama.*'       => 'nullable|string|max:255', // Nama anggota tim
            'team_peran.*'      => 'nullable|string|max:255', // Peran anggota tim
            'team_foto.*'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Foto anggota tim
        ]);

        $userJurusan = strtoupper(trim($user->jurusan ?? ''));
        $kategoriId = $this->jurusanMap[$userJurusan] ?? 0;
        
        // Simpan gambar utama (thumbnail)
        $pathUtama = $request->file('gambar')->store('portofolio', 'public');

        // 1. Simpan data utama ke tabel portofolios
        $portofolio = Portofolio::create([
            'judul'       => $request->judul,
            'kategori_id' => $kategoriId,
            'pembuat'     => $request->pembuat,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $pathUtama,
        ]);

        // 2. Simpan Gambar Slider (Jika ada)
        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $image) {
                $pathSlider = $image->store('portofolio/slider', 'public');
                PortofolioImage::create([
                    'portofolio_id' => $portofolio->id,
                    'gambar'        => $pathSlider,
                ]);
            }
        }

        // 3. Simpan Anggota Tim (Jika ada)
        if ($request->has('team_nama')) {
            $teamNamas = $request->team_nama;
            $teamPerans = $request->team_peran;
            $teamFotos = $request->file('team_foto');

            for ($i = 0; $i < count($teamNamas); $i++) {
                if (!empty($teamNamas[$i])) {
                    $fotoTimPath = null;
                    if (isset($teamFotos[$i])) {
                        $fotoTimPath = $teamFotos[$i]->store('portofolio/team', 'public');
                    }

                    PortofolioTeam::create([
                        'portofolio_id' => $portofolio->id,
                        'nama'          => $teamNamas[$i],
                        'peran'         => $teamPerans[$i] ?? 'Anggota',
                        'foto'          => $fotoTimPath,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Portofolio ' . $user->jurusan . ' berhasil ditambahkan beserta detailnya!');
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

        // Hapus file fisik gambar utama
        if ($portofolio->gambar && Storage::disk('public')->exists($portofolio->gambar)) {
            Storage::disk('public')->delete($portofolio->gambar);
        }

        // Hapus file fisik gambar slider
        foreach ($portofolio->images as $img) {
            if ($img->gambar && Storage::disk('public')->exists($img->gambar)) {
                Storage::disk('public')->delete($img->gambar);
            }
        }

        // Hapus file fisik foto tim
        foreach ($portofolio->teams as $team) {
            if ($team->foto && Storage::disk('public')->exists($team->foto)) {
                Storage::disk('public')->delete($team->foto);
            }
        }

        // Data di DB (images dan teams) otomatis terhapus karena onDelete('cascade') di migration
        $portofolio->delete();

        return redirect()->back()->with('success', 'Portofolio beserta seluruh detailnya berhasil dihapus!');
    }
    
    // Catatan: Fungsi update() sementara bisa menggunakan logika yang lama, 
    // atau nanti kita buatkan form update khusus untuk slider dan tim secara terpisah.
    public function update(Request $request, $id)
    {
        // ... (Kode update lama Anda biarkan saja dulu) ...
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

        return redirect()->back()->with('success', 'Info utama Portofolio berhasil diperbarui!');
    }

    public function show($id)
    {
        // Ambil data portofolio beserta foto slider dan anggota timnya
        $portofolio = Portofolio::with(['images', 'teams'])->findOrFail($id);
        
        return view('portofolio-detail', compact('portofolio'));
    }

    // Menghapus satu gambar slider spesifik
    public function destroyImage($id)
    {
        $image = \App\Models\PortofolioImage::findOrFail($id);
        if ($image->gambar && Storage::disk('public')->exists($image->gambar)) {
            Storage::disk('public')->delete($image->gambar);
        }
        $image->delete();
        return redirect()->back()->with('success', 'Gambar slider berhasil dihapus.');
    }

    // Menghapus satu anggota tim spesifik
    public function destroyTeam($id)
    {
        $team = \App\Models\PortofolioTeam::findOrFail($id);
        if ($team->foto && Storage::disk('public')->exists($team->foto)) {
            Storage::disk('public')->delete($team->foto);
        }
        $team->delete();
        return redirect()->back()->with('success', 'Anggota tim berhasil dihapus.');
    }
}