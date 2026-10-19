<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect jika user adalah admin
        if ($user->role === 'admin_pusat' || $user->role === 'admin pusat') {
            return redirect()->route('admin-pusat.dashboard');
        } elseif ($user->role === 'admin_jurusan' || $user->role === 'admin jurusan') {
            return redirect()->route('admin-jurusan.dashboard');
        }

        // Statistik pesanan user
        $totalPesanan = Pesanan::where('user_id', $user->id)->count();

        $pesananDiproses = Pesanan::where('user_id', $user->id)
            ->whereIn('status', ['Pending', 'Tahap Pembuatan', 'Pengemasan'])
            ->count();

        $pesananSelesai = Pesanan::where('user_id', $user->id)
            ->whereIn('status', ['Siap Diambil', 'Sudah Diambil'])
            ->count();

        $totalKeranjang = Keranjang::where('user_id', $user->id)->sum('jumlah') ?: 0;

        // 5 Pesanan terbaru
        $recentOrders = Pesanan::with(['produk.kategori', 'detailPesanans.produk.kategori'])
            ->where('user_id', $user->id)
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('user-dashboard', compact(
            'user',
            'totalPesanan',
            'pesananDiproses',
            'pesananSelesai',
            'totalKeranjang',
            'recentOrders'
        ));
    }
}

