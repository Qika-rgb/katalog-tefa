<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminPusatController extends Controller
{
    // STEP 1 — Product Report
    public function productReport()
    {
        $produks = Produk::all();
        return view('admin-pusat-status', compact('produks'));
    }

    // STEP 2 — Verifikasi Pesanan (Menampilkan Pesanan yang Perlu Diverifikasi + Riwayat Selesai)
public function verifikasi()
{
    // Pesanan baru yang masih perlu di-ACCEPT/DECLINE
    $pesanans = Pesanan::with(['user', 'produk'])
        ->where('status', 'Pending')
        ->latest('updated_at')
        ->get();

    // Riwayat pesanan yang sudah selesai (No. 5)
    $riwayatSelesai = Pesanan::with(['user', 'produk'])
        ->where('status', 'Sudah Diambil')
        ->latest('updated_at')
        ->get();

    return view('admin-pusat-verifikasi', compact('pesanans', 'riwayatSelesai'));
}

    // STEP 3 — ACCEPT
    public function accept($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => 'Tahap Pembuatan']);

        return redirect()->back()->with('success', 'Pesanan diterima!');
    }

    // STEP 4 — DECLINE
    public function decline($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => 'Ditolak']);

        return redirect()->back()->with('success', 'Pesanan ditolak!');
    }

    // STEP 5 — Status Pesanan (Proses Berjalan)
    public function statusPesanan()
    {
        $pesanans = Pesanan::with('produk')
            ->whereIn('status', ['Tahap Pembuatan', 'Pengemasan', 'Siap Diambil'])
            ->latest()
            ->get();

        return view('admin-pusat-status-pesanan', compact('pesanans'));
    }

    // STEP 6 — Ubah Status Berjenjang
    public function ubahStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $alurStatus = [
            'Tahap Pembuatan' => 'Pengemasan',
            'Pengemasan'      => 'Siap Diambil',
            'Siap Diambil'    => 'Sudah Diambil',
        ];

        $statusSekarang = $pesanan->status;

        if (isset($alurStatus[$statusSekarang])) {
            $pesanan->update([
                'status' => $alurStatus[$statusSekarang]
            ]);

            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . $alurStatus[$statusSekarang]);
        }

        return redirect()->back()->with('error', 'Status pesanan tidak dapat diubah lagi.');
    }

    // STEP 7 — Menampilkan Pesanan Selesai
    public function done()
    {
        $pesanans = Pesanan::with('produk')
            ->where('status', 'Sudah Diambil')
            ->latest()
            ->get();

        return view('admin-pusat-done', compact('pesanans'));
    }
}