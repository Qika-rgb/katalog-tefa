<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Keranjang; // PENTING: Panggil model Keranjang

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        // PERBAIKAN: Ambil data dari tabel keranjang di database, BUKAN dari session
        $keranjangs = Keranjang::with('produk')->where('user_id', Auth::id())->get();

        return view('checkout', compact('keranjangs'));
    }

    // Menyimpan pesanan
    public function store(Request $request)
    {
        // Validasi data pembeli
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $user_id = Auth::id();
        
        // Ambil keranjang dari database
        $keranjangs = Keranjang::with('produk')->where('user_id', $user_id)->get();

        // Jika keranjang kosong
        if ($keranjangs->isEmpty()) {
            return redirect('/keranjang')
                ->with('error', 'Keranjang masih kosong.');
        }

        DB::transaction(function () use ($request, $keranjangs, $user_id) {

            // Ambil item pertama dari keranjang (karena tabel pesananmu butuh 1 produk_id utama)
            $produkPertama = $keranjangs->first();

            // Hitung total jumlah barang
            $totalJumlah = $keranjangs->sum('jumlah');

            // Simpan pesanan utama
            $pesanan = Pesanan::create([
                'produk_id'   => $produkPertama->produk_id,
                'user_id'     => $user_id, // <-- UBAH BAGIAN INI (Sebelumnya customer_id)
                'no_telepon'  => $request->telepon,
                'jumlah'      => $totalJumlah,
                'status'      => 'Pending', 
            ]);

            // Simpan setiap produk ke detail pesanan
            foreach ($keranjangs as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id'  => $item->produk_id,
                    'jumlah'     => $item->jumlah,
                    'harga'      => $item->produk->harga, // Ambil harga langsung dari relasi tabel produk
                ]);
            }

            // PERBAIKAN: Kosongkan keranjang dari DATABASE setelah checkout berhasil
            Keranjang::where('user_id', $user_id)->delete();
        });

        // Kembali ke halaman status
        return redirect('/status')
            ->with('success', 'Pesanan berhasil dibuat dan menunggu verifikasi Admin!');
    }
}